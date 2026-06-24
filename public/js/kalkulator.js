document.addEventListener('DOMContentLoaded', function() {
    const calcBahan = document.getElementById('calcBahan');
    const calcKerumitan = document.getElementById('calcKerumitan');
    const calcTotal = document.getElementById('calcTotal');

    if (!calcBahan || !calcKerumitan || !calcTotal) return;

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(angka);
    }

    function calculateTotal() {
        // Ambil harga dasar dari attribute data-base-price yang di set oleh PHP
        const basePrice = parseInt(calcTotal.dataset.basePrice) || 0;
        
        const valBahan = parseInt(calcBahan.value) || 0;
        const valKerumitan = parseInt(calcKerumitan.value) || 0;

        const total = basePrice + valBahan + valKerumitan;
        
        // Update UI
        calcTotal.textContent = formatRupiah(total);
        calcTotal.dataset.total = total; // Store for WhatsApp script
    }

    // Event Listeners
    calcBahan.addEventListener('change', calculateTotal);
    calcKerumitan.addEventListener('change', calculateTotal);

    // Initial Calculation
    calculateTotal();
});
