// Agrega un evento de escucha al campo de entrada con el ID 'searchInput'
document.getElementById('searchInput').addEventListener('input', function () {
  let filter, table, tr, td, i, txtValue;
  
  // Obtiene el valor del campo de entrada y lo convierte a mayúsculas para la comparación
  filter = this.value.toUpperCase();
  
  // Obtiene la tabla que se va a filtrar (asume que tiene la clase 'table')
  table = document.querySelector('.table');
  
  // Obtiene todas las filas de la tabla
  tr = table.getElementsByTagName('tr');

  // Recorre todas las filas de la tabla
  for (i = 1; i < tr.length; i++) {
      let found = false;
      
      // Recorre todas las celdas de la fila actual
      for (let j = 0; j < tr[i].getElementsByTagName('td').length; j++) {
          td = tr[i].getElementsByTagName('td')[j];
          
          if (td) {
              // Obtiene el contenido de texto de la celda
              txtValue = td.textContent || td.innerText;
              
              // Comprueba si el texto de la celda contiene el filtro de búsqueda
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  found = true;
                  break;
              }
          }
      }
      
      // Muestra u oculta la fila dependiendo de si se encontró el texto de búsqueda
      if (found) {
          tr[i].style.display = '';
      } else {
          tr[i].style.display = 'none';
      }
  }
});

  