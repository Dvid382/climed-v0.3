// Función para generar las opciones de hora con intervalos de 15 minutos
function generateTimeOptions() {
    const horaInicio = 8; // Hora de inicio (8:00 AM)
    const horaFin = 17; // Hora de fin (5:00 PM)
    const intervalos = 4; // Número de intervalos por hora (4 intervalos de 15 minutos)

    const horaSelect = document.getElementById('hora');

    for (let hora = horaInicio; hora <= horaFin; hora++) {
        for (let i = 0; i < intervalos; i++) {
            const minutos = i * 15;
            const horaFormateada = `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
            const option = document.createElement('option');
            option.value = horaFormateada;
            option.text = horaFormateada;
            horaSelect.add(option);
        }
    }
}

// Llamar a la función para generar las opciones de hora
generateTimeOptions();