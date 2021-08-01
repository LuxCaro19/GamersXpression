new Vue({

    el:'#pubDetlles',

    data:{
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        publiID: new URLSearchParams(window.location.search).get('id'),
        publicacion: [],
        usrActual:'',
        reporte:[],
        razones:[],
        comentariosList:[],
        comSeleccionado:'',
        pubSeleccionada:'',
        raz:'',
        descripcion:'',
        comentmode: false,
        comentario:'',
    },

    methods:{
        //funcion para gargar la lista de usuarios desde el controlador
        cargarPublicacion: async function(id){
            var recurso = "controllers/ControlDetallesPublicacion.php";
            var form = new FormData();
            form.append("id", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.publicacion=data[0];
                    this.usrActual = data[1];
                    this.cargarMaterializecss();
                    
            }catch(error){


                console.log(error);

            }

        },
        alertDLT: function (pub){
            this.pubSeleccionada = pub;
            $('#eliminar').modal('open');
        },
        alertDLTCOM: function (com){
            this.comSeleccionado = com;
            $('#eliminarC').modal('open');
        },
        alrtREP: function (pub){
            this.pubSeleccionada = pub;
            this.cargarRazones();
            $('#reportar').modal('open');
            M.updateTextFields();
        },
        alrtREPCOM: function (com){
            this.comSeleccionado = com;
            this.cargarRazones();
            $('#reportarC').modal('open');
            M.updateTextFields();
        },
        modoComentar: function (){
            if (this.comentmode == true) {
                this.comentmode = false
            } else {
                this.comentmode = true;
            }
        },
        reportarPub: async function(accion){
            var recurso = "controllers/ControlReportar.php";
            var form = new FormData();
            if (accion == 1) {
                form.append("id", this.comSeleccionado);
            }
            if (accion == 2) {
                form.append("id", this.pubSeleccionada);
            }
            form.append("descripcion", this.descripcion);
            form.append("id_razon_report", this.raz);
            form.append("accion", accion);
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    this.pubSeleccionada = '';
                    this.comSeleccionado = '';
                    this.descripcion = '';
                    this.raz;
                    this.cargarPublicacion();
                      
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
                    window.location.href = this.url+'view/verMisPublicaciones.php';
                    

                                        
            }catch(error){
                console.log(error);

            }

        },
        eliminarCom: async function(id){
            var recurso = "controllers/EliminarComentario.php";
            var form = new FormData();
            form.append("id", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    if (data['ok'] == 'si'){
                        this.comentario ='';
                        this.cargarComentarios(this.publicacion.id_publicacion);
                        this.comentmode = false;

                    }
                    M.toast({html: data["msg"]})
                    

                                        
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
                    this.cargarPublicacion(id);  

            }catch(error){
                console.log(error);

            }

        },
        crearComentario: async function(){
            var recurso = "controllers/ControlComentario.php";
            var form = new FormData();
            form.append("id", this.publicacion.id_publicacion);
            form.append("comentario", this.comentario);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    if (data['ok'] == 'si'){
                        this.comentario ='';
                        this.cargarComentarios(this.publicacion.id_publicacion);
                        this.comentmode = false;

                    }
                    M.toast({html: data["msg"]})
                    

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
        cargarComentarios: async function(id){
            var recurso = "controllers/ControlCargarComentarios.php";
            var form = new FormData();
            form.append("id", id);
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.cargarPublicacion(id);
                    this.comentariosList = data;

            }catch(error){
                console.log(error);

            }

        },

        cargarMaterializecss: function(){
            $(document).ready(function(){
                $('.tooltipped').tooltip();
                $('.sidenav').sidenav();
                $('select').formSelect();
                $('.modal').modal();
                $('.materialboxed').materialbox();
            });
        }
           
       
    },
    //al iniciar, carga la lista de publicaciones
    created(){
        this.cargarPublicacion(this.publiID); 
        this.cargarRazones();
        this.cargarComentarios(this.publiID);  
        this.cargarMaterializecss();

    },





});