new Vue({

    el:'#formulario',

    data:{
        //http://localhost//GamersXpression/
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        
        compania: [],
        genero: [],
        secuela: [],
        nombre:'',
        resumen:'',
        imagen:[],
        com:'',
        gen:'',
        sec:'',
        pathh:''
        



    },

    methods:{

        cargarDatos: async function(id){
            this.reload = false;
            var recurso = "controllers/ControlDatosNuevoJuego.php";
            var form = new FormData();

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });
           
                    const data = await resp.json();
                    this.compania=data[0];
                    this.genero=data[1];
                    this.secuela=data[2];
                   
                    $(document).ready(function(){
                        $('select').formSelect();
                      });

            }catch(error){


                console.log(error);

            }

        },
        processFile(event) {
            this.imagen = event.target.files[0]
            this.pathh= event.target.files[0]['name'];
        },

        limpiarcampos(event) {
            this.nombre = '';
            this.resumen = '';
            this.imagen = '';
            this.com='';
            this.gen='';
            this.sec='';
            this.pathh='';
            this.cargarMaterializecss();
        },

         crearJuego: async function(){
            
            var recurso = "controllers/ControlJuego.php";
            var form = new FormData();
            form.append("nombre", this.nombre);
            form.append("resumen", this.resumen);
            form.append("compania", this.com);
            form.append("categoria", this.gen);
            form.append("secuela", this.sec);
            form.append("imagen", this.imagen);
           
            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });
                
                    const data = await resp.json();
                    M.toast({html: data.msg})
                    if (data.ok == "ok"){
                        this.limpiarcampos();
                    }
                    this.cargarJuegos(this.juegoID);          

            }catch(error){


                console.log(error);

            }

        },
        cargarMaterializecss() {
            $(document).ready(function(){
                $('select').formSelect();
              });
            M.updateTextFields();
        },
              
    },

    created(){
        this.cargarDatos();
        this.cargarMaterializecss();
    },





});
