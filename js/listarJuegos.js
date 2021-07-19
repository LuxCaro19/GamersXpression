new Vue({

    el:'#busqueda',

    data:{
        //http://localhost//GamersXpression/
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        juegos: [],
        pagina: 0,
        busqueda: '',
        busquedadalsa: '',
        cantidad: '',
        listapaginas: []


    },

    methods:{

        cargarJuegos: async function(){
            var recurso = "controllers/ControlListaJuego.php";
            var form = new FormData();
            form.append("busqueda", this.busqueda);
            form.append("pagina", this.pagina);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    this.juegos=data[0];
                    total= data[1];
                    this.cantidad= data[2];
                    this.listapaginas = [];

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
        
        irAJuego: async function(id){
            window.location.href = this.url+'/view/detalleJuego.php?id_juego='+id;
        },

        paginar: function(id){
            newpage = this.pagina+id;
            if (newpage >= 0 && newpage <= this.listapaginas.length-1) {
            this.pagina = newpage;
            this.cargarJuegos();}
        },

        irApagina: function(id){
            this.pagina = id;
            this.cargarJuegos();
        },

        buscarJuego: function(){
            this.pagina = 0;
            this.busqueda = this.busquedadalsa;
            this.cargarJuegos();
        }
           
       
    },

    created(){
        this.cargarJuegos();
    },





});