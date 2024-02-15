// Variables globales para elementos del DOM y contador
let $doctor, $date, $especialidad, iRadio;
let $horasMorning, $horasAfternoon, $titleMorning, $titleAfternoon;

// Constantes para títulos y mensaje de falta de horas disponibles
const titleMorning = `
    En la Mañana
`;

const titleAfternoon = `
    En la Tarde
`;

const noHoras = `<h5 class="text-danger"> 
    No hay horas disponibles
</h5>`;

// Ejecución una vez que el DOM está listo
$(function () {
  // Asignación de selectores a variables
  $especialidad = $('#especialidad');
  $doctor = $('#doctor');
  $date = $('#date');
  $titleMorning = $('#titleMorning');
  $horasMorning = $('#horasMorning');
  $titleAfternoon = $('#titleAfternoon');
  $horasAfternoon = $('#horasAfternoon');

  // Evento de cambio para el campo de especialidad
  $especialidad.change(() => {
    const especialidadId = $especialidad.val();
    const url = `/especialidades/${especialidadId}/doctores`;
    // Obtención de doctores de acuerdo a la especialidad seleccionada
    $.getJSON(url, onDoctoresLoaded);
  });

  // Eventos de cambio para el campo de doctor y fecha
  $doctor.change(loadHoras);
  $date.change(loadHoras);
});

// Función para cargar los doctores relacionados con una especialidad
function onDoctoresLoaded(doctores) {
  let htmlOptions = '';
  // Generación de opciones HTML para el selector de doctores
  doctores.forEach(doctor => {
    htmlOptions += `<option value="${doctor.id}">${doctor.nombre}</option>`;
  });
  $doctor.html(htmlOptions);
}

// Función para cargar los horarios disponibles
function loadHoras() {
  const selectedDate = $date.val();
  const doctorId = $doctor.val();
  const url = `/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;
  // Obtención de horarios disponibles y visualización en la interfaz
  $.getJSON(url, displayHoras);
}

// Función para cargar doctores según una especialidad seleccionada
function loadDoctores(especialidadId) {
  const url = `/especialidades/${especialidadId}/doctores`;
  $.getJSON(url, onDoctoresLoaded);
}

// Función para mostrar los horarios disponibles en la interfaz
function displayHoras(data) {
  console.log(data);

  let htmlHorasM = '';
  let htmlHorasA = '';
  iRadio = 0;

  // Generación de HTML para los intervalos de la mañana
  if (data.morning) {
    const morning_intervalos = data.morning;
    morning_intervalos.forEach(intervalo => {
      htmlHorasM += getRadioIntevalosHTML(intervalo);
    });
  }
  // Si no hay horarios de la mañana, se agrega el mensaje de falta de horarios
  if (!htmlHorasM != "") {
    htmlHorasM += noHoras;
  }

  // Generación de HTML para los intervalos de la tarde
  if (data.afternoon) {
    const afternoon_intervalos = data.afternoon;
    afternoon_intervalos.forEach(intervalo => {
      htmlHorasA += getRadioIntevalosHTML(intervalo);
    });
  }
  // Si no hay horarios de la tarde, se agrega el mensaje de falta de horarios
  if (!htmlHorasA != "") {
    htmlHorasA += noHoras;
  }

  // Mostrar los horarios de la mañana y la tarde en la interfaz
  $horasMorning.html(htmlHorasM);
  $horasAfternoon.html(htmlHorasA);
  $titleMorning.html(titleMorning);
  $titleAfternoon.html(titleAfternoon);
}

// Función para generar el HTML de los intervalos de tiempo como botones de radio
function getRadioIntevalosHTML(intervalo) {
  const text = `${intervalo.start} - ${intervalo.end}`;

  return `<div class="custom-control custom-radio mb-3">
          <input type="radio" id="interval${iRadio}" name="time" value="${intervalo.start}" class="custom-control-input"  required>
          <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
          </div>`;
}
