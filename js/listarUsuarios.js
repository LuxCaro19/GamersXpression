new Vue({

    el:'#usuarios',

    data:{
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        usuarios: [],
        pagina: 0,
        usrSeleccionado:'',
        busqueda: '',
        cantidad: '',
        busquedadalsa: '',
        listapaginas: []


    },

    methods:{
        //funcion para gargar la lista de usuarios desde el controlador
        cargarUsuarios: async function(){
            var recurso = "controllers/ControlListaUsuario.php";
            var form = new FormData();
            form.append("busqueda", this.busqueda);
            form.append("pagina", this.pagina);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.usuarios=data[0];
                    total= data[1];
                    this.cantidad= data[2];
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
                    
            }catch(error){


                console.log(error);

            }

        },
        mostrarmensaje: function (usr){
            this.usrSeleccionado = usr;
        },

        ejecutarAccion: async function(accion,id){

            if (id == 3){
            this.usrSeleccionado ='';}

            var recurso = "controllers/ControlAccionUsuario.php";
            var form = new FormData();
            form.append("accion", accion);
            form.append("id_usuario", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    this.cargarUsuarios();
                    

                                        
            }catch(error){
                console.log(error);

            }

        },
        //funcion para redirigir a los detalles de un juego
        irAJuego: async function(id){
            window.location.href = this.url+'view/detalleJuego.php?id_juego='+id;
        },

        //funcion para apretar el boton pagina anterior o el boton pagina siguiente
        paginar: function(id){
            newpage = this.pagina+id;
            if (newpage >= 0 && newpage <= this.listapaginas.length-1) {
            this.pagina = newpage;
            this.cargarUsuarios();}
        },
        //funcion para apretar un boton de la pagina yvalla directamente a esa pagina
        irApagina: function(id){
            this.pagina = id;
            this.cargarUsuarios();
        },

        //funcion para  realizar una busqueda, la abusqueda se guarda en una variable diferente al campo de texto para que no cambie al apretar otros botones
        buscarJuego: function(){
            this.pagina = 0;
            this.busqueda = this.busquedadalsa;
            this.cargarUsuarios();
        }
           
       
    },
    //al iniciar, carga la lista de usuarios
    created(){
        $(document).ready(function() {

            $('.modal').modal();
            
        });
        this.cargarUsuarios();
       
    },





});