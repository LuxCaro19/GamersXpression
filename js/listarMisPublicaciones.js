new Vue({

    el:'#publicaciones',

    data:{
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        publicaciones: [],
        pagina: 0,
        pubSeleccionada:'',
        busqueda: '',
        cantidad: '',
        busquedadalsa: '',
        usrActual:'',
        listapaginas: [],
        reporte:[],
        razones:[],
        raz:'',
        descripcion:'',


    },

    methods:{
        //funcion para gargar la lista de usuarios desde el controlador
        cargarPublicaciones: async function(){
            var recurso = "controllers/ControlListaMisPublicaciones.php";
            var form = new FormData();
            form.append("busqueda", this.busqueda);
            form.append("pagina", this.pagina);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.publicaciones=data[0];
                    total= data[1];
                    this.cantidad= data[2];
                    this.usrActual = data[3];
                    this.listapaginas = [];

                    //esto hace que se cargen las animaciones de los botones para paginar, el for se repite las y calcula cuantas paginas existen y va creando los numeros de pagina
                    //si la pagina actual concide con la del for, le da la propiedad activa para que la marque en rojo
                    for (var i = 0; i < total; i++) {         
                        if (i%this.cantidad == 0){
                            paginaactual = i/this.cantidad;
                            if (paginaactual == this.pagina){clase = "active"} else {clase = "waves-effect"}
                            this.listapaginas[paginaactual]=({pagina:paginaactual,clase});
                        }
                    }
                    this.cargarMaterializecss();
                    
            }catch(error){


                console.log(error);

            }

        },
        alertDLT: function (pub){
            this.pubSeleccionada = pub;
            $('#eliminar').modal('open');
        },
        alrtREP: function (pub){
            this.pubSeleccionada = pub;
            this.cargarRazones();
            $('#reportar').modal('open');
            M.updateTextFields();
        },
        reportarPub: async function(){
            var recurso = "controllers/ControlReportar.php";
            var form = new FormData();
            form.append("id", this.pubSeleccionada);
            form.append("descripcion", this.descripcion);
            form.append("id_razon_report", this.raz);
            form.append("accion", 2);
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    this.pubSeleccionada = '';
                    this.descripcion = '';
                    this.raz;
                    this.cargarPublicaciones();
                      
            }catch(error){
                console.log(error);

            }
        },

        eliminarPub: async function(id){
            var recurso = "controllers/EliminarPublicacion.php";
            var form = new FormData();
            form.append("id_elim", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    this.cargarPublicaciones();
                    

                                        
            }catch(error){
                console.log(error);

            }

        },
        like: async function(id){
            var recurso = "controllers/ControlMeGusta.php";
            var form = new FormData();
            form.append("id_publicacion", id);
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    this.cargarPublicaciones();  

            }catch(error){
                console.log(error);

            }

        },
        cargarRazones: async function(id){
            var recurso = "controllers/ControlRazonesReportes.php";
            var form = new FormData();
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.razones = data;

            }catch(error){
                console.log(error);

            }

        },

        //funcion para apretar el boton pagina anterior o el boton pagina siguiente
        paginar: function(id){
            newpage = this.pagina+id;
            if (newpage >= 0 && newpage <= this.listapaginas.length-1) {
            this.pagina = newpage;
            this.cargarPublicaciones();}
        },
        //funcion para apretar un boton de la pagina yvalla directamente a esa pagina
        irApagina: function(id){
            this.pagina = id;
            this.cargarPublicaciones();
        },

        //funcion para  realizar una busqueda, la abusqueda se guarda en una variable diferente al campo de texto para que no cambie al apretar otros botones
        buscarPublicacion: function(){
            this.pagina = 0;
            this.busqueda = this.busquedadalsa;
            this.cargarPublicaciones();
        },
        cargarMaterializecss: function(){
            $(document).ready(function(){
                $('.tooltipped').tooltip();
                $('.sidenav').sidenav();
                $('select').formSelect();
                $('.modal').modal();
            });
        }
           
       
    },
    //al iniciar, carga la lista de publicaciones
    created(){
        this.cargarPublicaciones();  
        this.cargarRazones();  
        this.cargarMaterializecss();

    },





});