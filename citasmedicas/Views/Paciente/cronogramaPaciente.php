<?php
  session_start();

  if (!isset($_SESSION['userId'])) {
    header("Location: ../../index.php");
    exit();
  }

  include_once '../../conexion.php';
  $conexion = conectarse();

  $query = "SELECT tbusuario.dniusuario, tbusuario.nombres, tbusuario.apellidos, tbusuario.contrasenia, tbusuario.correo, 
            tbusuario.telefono, tbusuario.fechanacimiento, tbrol.nombre, tbusuario.direccion 
            FROM tbusuario
            INNER JOIN tbrol
            ON tbrol.idrol = tbusuario.fk_idrol
            WHERE tbusuario.dniusuario = ?";

  $stmt = $conexion->prepare($query);
  $stmt->bind_param("s", $_SESSION['userId']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreCompleto = $row['nombres'] . ' ' . $row['apellidos'];
    $nombre = $row['nombres'];
    $apellido = $row['apellidos'];
    $correo = $row['correo'];
    $rol = $row['nombre'];
  } else {
    echo "Error: Usuario no encontrado";
    exit();
  }

  $stmt->close();
  $conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cronograma del Paciente</title>
    <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../../assets/css/styles.min.css" />
    <!-- SCRIPT DE TAILWINDCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="dns-prefetch" href="//unpkg.com" />
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="indexPaciente.php" class="text-nowrap logo-img">
            <img src="../../assets/images/logos/essalud_logo.jpg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Perfil</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="indexPaciente.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Informacion del paciente</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Citas Médicas</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="agendarCita.php" aria-expanded="false">
                <span>
                  <i class="ti ti-book-2"></i>
                </span>
                <span class="hide-menu">Reservar cita médica</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="cronogramaPaciente.php" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar-smile"></i>
                </span>
                <span class="hide-menu">Cronograma</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="doctorpaciente.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Doctores</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="especialidadpaciente.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Especialidades</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">IA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="chatbot.php" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Chat Bot - Médico</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3"><?php echo $nombreCompleto; ?></p>
                    </a>
                    <a href="../../index.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Cerrar Sesión</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <div class="container-fluid">
        <div class="antialiased sans-serif">
          <div x-data="app()" x-init="[initDate(), getNoOfDays(), loadCitas()]" x-cloak>
            <div class="container mx-auto px-10S py-2 md:py-24">
              <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="flex items-center justify-between py-2 px-6">
                  <div>
                    <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                    <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                  </div>
                  <div class="border rounded-lg px-1" style="padding-top: 2px;">
                    <button type="button" class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" :class="{'cursor-not-allowed opacity-25': month == 0 }" :disabled="month == 0 ? true : false" @click="month--; getNoOfDays()">
                      <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                      </svg>
                    </button>
                    <div class="border-r inline-flex h-6"></div>
                    <button type="button" class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" :class="{'cursor-not-allowed opacity-25': month == 11 }" :disabled="month == 11 ? true : false" @click="month++; getNoOfDays()">
                      <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="-mx-1 -mb-1">
                  <div class="flex flex-wrap border-t border-l">
                    <template x-for="blankday in blankdays">
                      <div style="width: 14.28%; height: 120px" class="text-center border-r border-b px-4 pt-2"></div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                      <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                        <div @click="showEventModal(date)" x-text="date" class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100" :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"></div>
                        <div style="height: 80px;" class="overflow-y-auto mt-1">
                          <div class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none" x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length" x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div>
                          <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() === new Date(year, month, date).toDateString() )">
                            <div class="px-2 py-1 rounded-lg mt-1 overflow-hidden border" :class="{'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue', 'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red', 'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow', 'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green', 'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'}">
                              <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                            </div>
                          </template>
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
            <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="openEventModal">
              <div class="p-4 max-w-xl mx-auto relative left-0 right-0 overflow-hidden mt-24">
                <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer" x-on:click="openEventModal = !openEventModal">
                  <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z"/>
                  </svg>
                </div>
                <div class="shadow w-full rounded-lg bg-white overflow-hidden block p-8">
                  <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Detalles de la Cita</h2>
                  <div class="mb-4">
                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Fecha de la cita</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_date" readonly>
                  </div>
                  <div class="mb-4">
                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Especialidad</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_specialty" readonly>
                  </div>
                  <div class="mb-4">
                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Doctor</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_doctor" readonly>
                  </div>
                  <div class="mb-4">
                    <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Hora</label>
                    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="event_time" readonly>
                  </div>
                  <div class="mt-8 text-right">
                    <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openEventModal = !openEventModal">
                      Cerrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
            const MONTH_NAMES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            const DAYS = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

            function app() {
              return {
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                events: [],
                event_date: '',
                event_specialty: '',
                event_doctor: '',
                event_time: '',
                openEventModal: false,
                initDate() {
                  let today = new Date();
                  this.month = today.getMonth();
                  this.year = today.getFullYear();
                },
                isToday(date) {
                  const today = new Date();
                  const d = new Date(this.year, this.month, date);
                  return today.toDateString() === d.toDateString() ? true : false;
                },
                showEventModal(date) {
                  this.event_date = new Date(this.year, this.month, date).toDateString();
                  const event = this.events.find(e => new Date(e.event_date).toDateString() === this.event_date);
                  if (event) {
                    this.event_specialty = event.event_specialty;
                    this.event_doctor = event.event_doctor;
                    this.event_time = event.event_time;
                    this.openEventModal = true;
                  }
                },
                getNoOfDays() {
                  let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                  let dayOfWeek = new Date(this.year, this.month).getDay();
                  let blankdaysArray = [];
                  for (var i = 1; i <= dayOfWeek; i++) blankdaysArray.push(i);
                  let daysArray = [];
                  for (var i = 1; i <= daysInMonth; i++) daysArray.push(i);
                  this.blankdays = blankdaysArray;
                  this.no_of_days = daysArray;
                },
                loadCitas() {
                  fetch('../../Controller/CronogramaPacienteController.php')
                    .then(response => response.json())
                    .then(data => {
                      this.events = data.map(cita => ({
                        event_date: cita.FechaAtencion,
                        event_specialty: cita.Especialidad,
                        event_doctor: cita.Doctor,
                        event_time: cita.InicioAtencion,
                        event_theme: 'blue'
                      }));
                    });
                }
              };
            }
          </script>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/js/sidebarmenu.js"></script>
  <script src="../../assets/js/app.min.js"></script>
  <script src="../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../assets/js/dashboard.js"></script>
</body>
</html>
