document.addEventListener("DOMContentLoaded", () => {
    // Função para aplicar gradiente vermelho (mais alto = mais vermelho)
    function colorRedScale(value, max) {
        const ratio = Math.min(value / max, 1);
        // Cor vai do branco (#fff) ao vermelho claro (#ffcccc)
        const r = 255;
        const g = Math.floor(255 - ratio * 204); // 255 -> 51
        const b = Math.floor(255 - ratio * 204);
        return `rgb(${r},${g},${b})`;
    }

    // Função para aplicar gradiente verde (mais alto = mais verde)
    function colorGreenScale(value, max) {
        const ratio = Math.min(value / max, 1);
        // Cor vai do branco (#fff) ao verde claro (#ccffcc)
        const r = Math.floor(255 - ratio * 204); // 255 -> 51
        const g = 255;
        const b = Math.floor(255 - ratio * 204);
        return `rgb(${r},${g},${b})`;
    }

    // 1. Transporte - coluna "Total CO₂ (kg/ano)" (última coluna)
    const transporteCells = [...document.querySelectorAll('.transport-table tbody tr td:last-child')];
    const transporteValues = transporteCells.map(td => parseFloat(td.textContent) || 0);
    const transporteMax = Math.max(...transporteValues);

    transporteCells.forEach((td, i) => {
        const val = transporteValues[i];
        if (val > 0) {
            td.style.backgroundColor = colorRedScale(val, transporteMax);
            td.classList.add('cell-red');
        } else {
            // valor 0, fundo branco
            td.style.backgroundColor = '#fff';
        }
    });

    // 2. Consumo energético - coluna "CO₂/mês (kg)" (última coluna)
    const consumoCells = [...document.querySelectorAll('.energy-table tbody tr td:last-child')];
    const consumoValues = consumoCells.map(td => parseFloat(td.textContent) || 0);
    const consumoMax = Math.max(...consumoValues);

    consumoCells.forEach((td, i) => {
        const val = consumoValues[i];
        if (val > 0) {
            td.style.backgroundColor = colorRedScale(val, consumoMax);
            td.classList.add('cell-red');
        } else {
            td.style.backgroundColor = '#fff';
        }
    });

    // 3. Dicas - coluna "Poupança CO₂/ano" (3ª coluna) - tem valores com "kg", vamos remover o "kg" e converter para número
    const dicasCells = [...document.querySelectorAll('.tips-table tbody tr td:nth-child(3)')];
    const dicasValues = dicasCells.map(td => {
        let text = td.textContent.replace(/[^\d.,]/g, '').replace(',', '.');
        return parseFloat(text) || 0;
    });
    const dicasMax = Math.max(...dicasValues);

    dicasCells.forEach((td, i) => {
        const val = dicasValues[i];
        if (val > 0) {
            td.style.backgroundColor = colorGreenScale(val, dicasMax);
            td.classList.add('cell-green');
        } else {
            td.style.backgroundColor = '#fff';
        }
    });
});