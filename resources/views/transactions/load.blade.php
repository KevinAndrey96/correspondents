<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon1.png">
    <title>
        Corresponsales
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('/assets/img/transaction-load.png'); background-position: center;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">

            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            @if (isset(Auth::user()->brand_id))
                                <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h5 class="text-white font-weight-bolder text-center mt-2 mb-2">Un momento por favor ...</h5>
                                </div>
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h5 class="text-white font-weight-bolder text-center mt-2 mb-2">Un momento por favor ...</h5>
                                </div>
                            @endif
                        </div>
                        <div style="position: relative;"  class="card-body">
                            <a href="#" id="chatIcon" style="position: absolute; left:70%; bottom:85%; display:none;" class="btn btn-info" title="Comunicarse con proveedor" onclick="openSecondaryWindow()">Chat<i style="color: white; font-size: 30px !important;" class="material-icons opacity-10">forum</i></a>
                            <div class="text-center mb-2">
                                <img  src="/assets/img/RelojArena2.gif" alt="gif" height="140px" width="200px">
                            </div>
                            <div class="text-center">
                                <p class="mb-1 text-xs font-weight-bold text-dark">Número de cuenta:<p class=" mb-2 text-xs font-weight-bold"> {{$transaction->account_number}}</p></p>
                                <p class="mb-1 text-xs font-weight-bold text-dark">Monto: <p class=" mb-2 text-xs font-weight-bold">${{number_format($transaction->amount, 2, ',', '.')}}</p></p>
                               <p class="mb-1 text-xs font-weight-bold text-dark">Tipo: <p class=" mb-2 text-xs font-weight-bold">
                                 @if ($transaction->type == 'Deposit')
                                  Deposito
                                 @endif
                                 @if ($transaction->type == 'Withdrawal')
                                  Retiro
                                 @endif
                               </p></p>
                                <p class="mb-1 text-xs font-weight-bold text-dark">Producto: <p class=" mb-2 text-xs font-weight-bold">{{$transaction->product->product_name}}</p></p>
                                <p class="mb-1 text-xs font-weight-bold text-dark">ID de proveedor: <p class=" mb-2 text-xs font-weight-bold" id="supplierID">{{$transaction->supplier_id}}</p></p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-center aling-content-middel" id="divStatus" style="margin-right:auto; margin-left:auto">
                                    <p class="text-center text-white text-sm p-2" id="pStatus" style="background-color:#E7B615; width:100%; border-radius: 10px;">En espera</p>
                                </div>
                                <div class="col-sm-6 text-center text-xs" id="out" style="display: none;">
                                    <a href="/transaction/cancel/{{$transaction->id}}" class="btn btn-danger w-100 mb-2" onclick="cancelAlert()">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
</main>
<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Aquí se ejecuta el método onload, que dice que esto se ejecutará apenas cargue la página
    window.onload = function() {
        axios.get('{{$url}}/api/getStatus/'+{{$transaction->id}})
            .then((res) => {
                //http://127.0.0.1:8000
                if (res.data.status == 'successful' || res.data.status == 'failed') {
                    window.location.replace("{{$url}}/transaction/detail/{{$transaction->id}}");
                }
            });
        window.alert('Su transacción se está realizando en este momento, por favor espere unos minutos mientras esta se completa.')
        // Aquí llama la función que está definida abajo, lo que hace es llamarla solamente y se le envia en los parentesis cuantos segundos queremos que pasen

        timerToCancel(180)


    };
    // Este método lo que hace es cancelar pasados X segundos según se le diga al momento de llamarlo
    function timerToCancel(segundos){
    // Aquí se ejecuta el código, entonces arriba recibe los segundos, abajo se le mandan
        setTimeout(function(){
            // Cuando pasen los segundos que le dijimos hará estas acciones a continuación
            axios.get('{{$url}}/api/getStatus/'+{{$transaction->id}})
                    .then((res)=>{
                        if (res.data.status == 'hold') {
                            document.getElementById('out').style.display = 'block';
                        }
                        if (res.data.status == 'accepted') {
                            document.getElementById('out').style.display = 'none';
                        }
                    });
        }, segundos * 1000);
    }
    function cancelAlert() {
        window.confirm('¿Está seguro de cancelar la transacción actual? recuerde que este proceso es irreversible')
    }
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<!--Import axios-->

<script>
    setInterval(function () {
        getStatus({{$transaction->id}})
    }, 5000 );

    function getStatus(id)
    {
        var pStatus = document.getElementById('pStatus');
        var divStatus = document.getElementById('divStatus');
        var pSupplierID = document.getElementById('supplierID');
        var chatIcon = document.getElementById('chatIcon');

        axios.get('{{$url}}/api/getStatus/'+id)
            .then((res)=> {
                    if (res.data.status == 'hold') {
                        pStatus.innerHTML = 'En espera';
                        pStatus.style.backgroundColor = '#E7B615';
                    }
                    if (res.data.status == 'accepted') {
                        pStatus.innerHTML = 'Aceptada';
                        pStatus.style.backgroundColor = 'dodgerblue';
                        chatIcon.style.display = 'block';
                        openSecondaryWindow();
                    }
                    if (res.data.status == 'successful' || res.data.status == 'failed' || res.data.status == 'cancelled') {
                        window.location.replace("{{$url}}/transaction/detail/{{$transaction->id}}");
                    }
                    pSupplierID.innerHTML = res.data.supplier_id;
            });
    }

</script>
<script type="text/javascript">
    function openSecondaryWindow()
    {
        var secondaryWindow;
        var iframe;

        secondaryWindow = window.open('', 'secondaryWindow', 'width=400,height=500');
        iframe = '<iframe src="{{$url.'/chat/'.$transaction->id}}" width="100%" height="100%">';
        secondaryWindow.document.write(iframe)
    }
</script>
</body>
</html>



