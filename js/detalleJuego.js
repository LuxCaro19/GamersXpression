new Vue({

    el:'#detalles',

    data:{
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        
        juegoID: new URLSearchParams(window.location.search).get('id_juego'),
        juegos: [],
        nombresecuela: '',
        calificacionjuego:[],
        calificacionusr:[],
        vacio:[],
        id: '',
    
    },

    methods:{

        cargarJuegos: async function(id){
            this.reload = false;
            var recurso = "controllers/ControlDetallesJuego.php";
            var form = new FormData();
            form.append("id", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });
           
                    const data = await resp.json();
                    this.juegos=data;
                    this.calificacionjuego = this.calificacionAestrellas(this.juegos.calificacion);
                    this.calificacionusr = this.calificacionAestrellas(this.juegos.calificacionusr);              
                    vm.$forceUpdate();
            }catch(error){


                console.log(error);

            }

        },

        calificar: async function(calificacion){
            
            var recurso = "controllers/ControlCalificar.php";
            var form = new FormData();
            form.append("id", this.juegoID);
            form.append("calificacion", calificacion+1);
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });
                
                    const data = await resp.json();
                    M.toast({html: data.msg})
                    this.cargarJuegos(this.juegoID);          

            }catch(error){


                console.log(error);

            }

        },
        irAJuego: async function(id){
            window.location.href = this.url+'view/detalleJuego.php?id='+id;
        },
        calificacionAestrellas: function(calificacion){
            star = [];
            for (i=0; i < 5; i++) {
                if ((calificacion-i) >= 0.5 && (calificacion-i) < 1) { star[i] = "fas fa-star-half-alt"}
                if ((calificacion-i) < 0.5) {star[i] = "far fa-star"}
                if ((calificacion-i) >= 1) { star[i] ="fas fa-star"}
            }
            return star;
        }
           
       
    },

    created(){
        this.cargarJuegos(this.juegoID);
    },





});
