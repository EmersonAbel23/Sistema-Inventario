

  <div id="reloj">Cargando...</div>

  <script>
    function actualizarReloj() {
     
      const opciones = {
        timeZone: 'America/Lima',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      };
      const horaPeru = new Intl.DateTimeFormat('es-PE', opciones).format(new Date());
      document.getElementById('reloj').textContent = horaPeru;
    }

    setInterval(actualizarReloj, 1000); 
    actualizarReloj(); 
  </script>

