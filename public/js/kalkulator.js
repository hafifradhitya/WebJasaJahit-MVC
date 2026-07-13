document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(angka);
    }

    function bindCalculator(idBahan, idKerumitan, idTotal) {
        const calcBahan = document.getElementById(idBahan);
        const calcKerumitan = document.getElementById(idKerumitan);
        const calcTotal = document.getElementById(idTotal);

        if (!calcBahan || !calcKerumitan || !calcTotal) return;

        function calculateTotal() {
            const basePrice = parseInt(calcTotal.dataset.basePrice) || 0;
            const valBahan = parseInt(calcBahan.value) || 0;
            const valKerumitan = parseInt(calcKerumitan.value) || 0;
            const total = basePrice + valBahan + valKerumitan;
            
            calcTotal.textContent = formatRupiah(total);
            calcTotal.dataset.total = total;
        }

        calcBahan.addEventListener('change', calculateTotal);
        calcKerumitan.addEventListener('change', calculateTotal);
        calculateTotal();
    }

    // Bind Right Side (WA)
    bindCalculator('calcBahan', 'calcKerumitan', 'calcTotal');
    
    // Bind Left Side (Website Form)
    bindCalculator('webCalcBahan', 'webCalcKerumitan', 'webCalcTotal');
});
