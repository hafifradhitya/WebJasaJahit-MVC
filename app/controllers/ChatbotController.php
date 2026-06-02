<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Controller.php';

class ChatbotController extends Controller {
    
    // API Key Hugging Face Anda
    private $apiKey = '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'; 
    // Model yang lebih kecil, stabil, dan cepat (selalu aktif di HuggingFace)
    private $modelId = 'Qwen/Qwen2.5-7B-Instruct';

    public function reply() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'reply' => 'Metode request tidak valid.']);
            exit;
        }

        $userMessage = $_POST['message'] ?? '';
        
        if (empty($userMessage)) {
            echo json_encode(['success' => false, 'reply' => 'Pesan tidak boleh kosong.']);
            exit;
        }

        // Prompt sistem agar AI memiliki persona sebagai Customer Service Toko Anda
        $systemPrompt = "Anda adalah Asisten Virtual AI yang ramah, profesional, dan cerdas untuk 'Jadimulya Jasa Jahit'. 
Tugas utama Anda adalah menjawab pertanyaan pelanggan terkait layanan jahit.
Berikut adalah informasi toko yang harus Anda pedomani:
- Lokasi: Jl. Gunung Jati Gg. Mushollah, Desa Jadimulya, RT 02/RW 01, Kab. Cirebon.
- Kontak Manual: WhatsApp +62 896-8250-6082 (untuk pemesanan spesifik).
- Jam Operasional: Senin - Sabtu, Pukul 09.00 - 18.00.
- Contoh Layanan & Harga Mulai: Jahit Biasa (Rp 50.000), Permak Celana (Rp 85.000), Seragam Formal (Rp 30.000), Jahit Pakaian Harian (Rp 25.000).
Aturan menjawab:
1. Jawab dengan bahasa Indonesia yang ramah, tidak kaku, dan sopan. Gunakan emoji secukupnya.
2. Jangan terlalu panjang, berikan jawaban yang padat dan jelas.
3. Jika pelanggan bertanya hal di luar konteks jasa jahit baju/pakaian, tolak dengan halus dan katakan Anda hanya bisa membantu seputar Jasa Jahit Jadimulya.
4. Jika pelanggan ingin memesan atau memberikan detail ukuran yang rumit, arahkan menghubungi WhatsApp.";

        // Format data menggunakan standar OpenAI (HuggingFace Messages API)
        $data = [
            "model" => $this->modelId,
            "messages" => [
                [
                    "role" => "system",
                    "content" => $systemPrompt
                ],
                [
                    "role" => "user",
                    "content" => $userMessage
                ]
            ],
            "max_tokens" => 500,
            "temperature" => 0.6
        ];

        // URL Endpoint standar HuggingFace Inference API untuk Chat
        $url = "https://api-inference.huggingface.co/models/" . $this->modelId . "/v1/chat/completions";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        // FIX for Laragon/XAMPP local SSL issue
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Set timeout to 60 seconds because HuggingFace might need time to load the model (cold start)
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            echo json_encode(['success' => false, 'reply' => 'Maaf, server AI sedang mengalami kendala jaringan. (cURL Error: ' . $err . ')']);
            exit;
        }

        $responseData = json_decode($response, true);
        
        if (isset($responseData['choices'][0]['message']['content'])) {
            $aiReply = $responseData['choices'][0]['message']['content'];
            
            // Format basic markdown to HTML for bolding
            $aiReply = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $aiReply);
            $aiReply = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $aiReply);
            
            echo json_encode(['success' => true, 'reply' => nl2br(trim($aiReply))]);
        } else {
            // Tampilkan error dari HuggingFace jika ada
            $errorMsg = $responseData['error'] ?? 'Respons dari HuggingFace tidak dikenali.';
            if (is_array($errorMsg)) {
                $errorMsg = json_encode($errorMsg);
            }
            echo json_encode(['success' => false, 'reply' => 'Maaf, server AI sedang sibuk. Error: ' . $errorMsg]);
        }
    }
}
