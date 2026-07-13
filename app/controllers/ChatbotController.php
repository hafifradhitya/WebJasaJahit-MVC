<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Layanan.php';

class ChatbotController extends Controller
{
    private const GEMINI_ENDPOINT = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=%s';
    private const WHATSAPP = '+62 896-8250-6082';
    private const WHATSAPP_LINK = 'https://wa.me/6289682506082';
    private const ADDRESS = 'Jl. Gunung Jati Gg. Mushollah, Desa Jadimulya, RT 02/RW 01, Kab. Cirebon';
    private const HOURS = 'Senin - Sabtu, pukul 09.00 - 18.00';

    public function reply(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendReply(false, 'Metode request tidak valid.');
        }

        $userMessage = trim((string) ($_POST['message'] ?? ''));
        if ($userMessage === '') {
            $this->sendReply(false, 'Pesan tidak boleh kosong.');
        }

        if ($this->getApiKey() === '') {
            $this->sendReply(false, 'Token Google Gemini belum diisi. Silakan isi GEMINI_API_KEY di file .env');
        }

        $history = $this->parseHistory((string) ($_POST['history'] ?? '[]'));
        $aiReply = $this->askGemini($userMessage, $history);

        if ($aiReply !== null) {
            $this->sendReply(true, $aiReply, 'google-gemini');
        }

        $this->sendReply(false, 'Maaf, Google Gemini belum bisa dihubungi. Silakan cek token / koneksi server, lalu coba lagi.');
    }

    private function askGemini(string $userMessage, array $history): ?string
    {
        $apiKey = $this->getApiKey();
        if ($apiKey === '') {
            return null;
        }

        $endpoint = sprintf(self::GEMINI_ENDPOINT, $apiKey);

        $contents = [];
        foreach (array_slice($history, -8) as $item) {
            $contents[] = [
                'role' => $item['role'], // 'user' or 'model'
                'parts' => [['text' => $item['content']]]
            ];
        }

        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $userMessage]]
        ];

        $payload = [
            'systemInstruction' => [
                'parts' => [
                    ['text' => $this->systemPrompt()]
                ]
            ],
            'contents' => $contents,
            'generationConfig' => [
                'maxOutputTokens' => 450,
                'temperature' => 0.55,
                'topP' => 0.9,
            ]
        ];

        $ch = curl_init($endpoint);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $curlError !== '' || $httpCode < 200 || $httpCode >= 300) {
            error_log('Gemini chatbot request failed. HTTP: ' . $httpCode . '; cURL: ' . $curlError . '; body: ' . substr((string) $response, 0, 700));
            return null;
        }

        $data = json_decode((string) $response, true);
        $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

        return is_string($reply) && trim($reply) !== '' ? trim($reply) : null;
    }

    private function systemPrompt(): string
    {
        return "Anda adalah Asisten AI customer service untuk Jadimulya Jasa Jahit.
Jawab dalam bahasa Indonesia yang ramah, sopan, natural, dan singkat.
Fokus hanya pada layanan jahit, permak, seragam, pakaian harian, harga, estimasi, alamat, jam buka, dan pemesanan.
Jika pelanggan bertanya di luar konteks jasa jahit, arahkan kembali dengan halus.

Informasi toko:
- Alamat: " . self::ADDRESS . "
- WhatsApp: " . self::WHATSAPP . "
- Link WhatsApp: " . self::WHATSAPP_LINK . "
- Jam operasional: " . self::HOURS . "

Daftar layanan aktif:
" . $this->serviceContext() . "

Aturan:
- Harga adalah harga mulai dan bisa berubah sesuai model, bahan, ukuran, serta tingkat kesulitan.
- Jangan menampilkan error teknis.
- Untuk pemesanan final atau detail ukuran, arahkan ke WhatsApp.";
    }

    private function serviceContext(): string
    {
        $lines = [];
        foreach ($this->getServices() as $service) {
            $line = '- ' . $service['name'] . ': mulai ' . $this->formatRupiah((int) $service['price']);
            if ($service['estimate'] !== '') {
                $line .= ', estimasi ' . $this->formatEstimate($service['estimate']);
            }
            if ($service['category'] !== '') {
                $line .= ', kategori ' . $service['category'];
            }
            $lines[] = $line;
        }

        return implode("\n", $lines);
    }

    private function getServices(): array
    {
        try {
            $serviceModel = new Layanan($this->db);
            $rows = $serviceModel->getActiveLayananWithKategori();
        } catch (Throwable $e) {
            $rows = [];
        }

        $services = [];
        foreach ($rows as $row) {
            $services[] = [
                'name' => (string) ($row->nama_layanan ?? ''),
                'price' => (int) ($row->harga_mulai ?? 0),
                'estimate' => (string) ($row->estimasi_hari ?? ''),
                'category' => (string) ($row->nama_kategori ?? ''),
            ];
        }

        return $services ?: [
            ['name' => 'Jahit Biasa', 'price' => 50000, 'estimate' => '3-7', 'category' => 'Jahit'],
            ['name' => 'Permak Celana', 'price' => 85000, 'estimate' => '1-3', 'category' => 'Permak'],
            ['name' => 'Seragam Formal', 'price' => 30000, 'estimate' => '3-7', 'category' => 'Seragam'],
            ['name' => 'Jahit Pakaian Harian', 'price' => 25000, 'estimate' => '2-5', 'category' => 'Jahit'],
        ];
    }

    private function parseHistory(string $historyJson): array
    {
        $decoded = json_decode($historyJson, true);
        if (!is_array($decoded)) {
            return [];
        }

        $history = [];
        foreach ($decoded as $item) {
            if (!is_array($item)) {
                continue;
            }

            // Gemini API expects roles to be either 'user' or 'model'
            $role = (string) ($item['role'] ?? '');
            if ($role === 'assistant') {
                $role = 'model';
            }

            $content = trim((string) ($item['content'] ?? ''));
            if (in_array($role, ['user', 'model'], true) && $content !== '') {
                $history[] = ['role' => $role, 'content' => substr($content, 0, 800)];
            }
        }

        return $history;
    }

    private function getApiKey(): string
    {
        // Fetch from .env
        $geminiApiKey = $_ENV['GEMINI_API_KEY'] ?? '';

        return trim($geminiApiKey);
    }

    private function formatRupiah(int $amount): string
    {
        return $amount > 0 ? 'Rp ' . number_format($amount, 0, ',', '.') : 'harga menyesuaikan';
    }

    private function formatEstimate(string $estimate): string
    {
        $estimate = trim($estimate);
        if ($estimate === '') {
            return 'menyesuaikan pesanan';
        }

        return preg_match('/hari/i', $estimate) ? $estimate : $estimate . ' hari kerja';
    }

    private function sendReply(bool $success, string $reply, string $source = 'system'): void
    {
        echo json_encode([
            'success' => $success,
            'source' => $source,
            'reply' => nl2br(htmlspecialchars($reply, ENT_QUOTES, 'UTF-8')),
        ]);
        exit;
    }
}
