new Vue({

    el:'#reportes',

    data:{
        //url:'http://localhost/GamersXpression/',
        url:'https://gamersxpression2021.herokuapp.com/',
        reportesP: [],
        reportesC: [],
        pagina: 0,
        usrSeleccionado:'',
        pubSeleccionada:[],
        comSeleccionado:[],
        razonSel:'',
        detallesSel:'',
        reportadoPor:'',
        reporteSel:'',
        cantidad: '',
        listapaginas: []


    },

    methods:{
        //funcion para gargar la lista de reportes desde el controlador
        cargarReportes: async function(num){
            var recurso = "controllers/ControlListaReporte.php";
            var form = new FormData();
            form.append("accion", num);
            form.append("pagina", this.pagina);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    if (num == 1) {this.reportesC=data[0];}
                    if (num == 2) {this.reportesP=data[0];}
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
        realizarAccion: async function(accion,id,num){
            var recurso = "controllers/ControlAccionModerar.php";
            var form = new FormData();
            form.append("accion", accion);
            form.append("id", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });
                    
                    const data = await resp.json();
                    M.toast({html: data["msg"]})
                    $('#verCom').modal('close');
                    $('#verPub').modal('close');
                    if (accion == 1 && num == 1) {this.realizarAccion(4,this.reportesC[this.reporteSel].id_report_comentario,1);}
                    if (accion == 1 && num == 2) {this.realizarAccion(5,this.reportesP[this.reporteSel].id_report_publicacion,1);}
                    this.cargarReportes(num);
                          
            }catch(error){
                console.log(error);

            }

        },

        verDetalles: async function(accion,id,index){
            var recurso = "controllers/ControlDetalleReporte.php";
            var form = new FormData();
            form.append("accion", accion);
            form.append("id", id);

            try{

                const resp = await fetch(this.url + recurso, {

                    method: "post",
                    body: form,

                });

                    const data = await resp.json();
                    
                    if (accion ==1) {
                        this.comSeleccionado=data[0];
                        this.razonSel = this.reportesC[index].razon;
                        this.detallesSel = this.reportesC[index].descripcion;
                        this.reportadoPor = this.reportesC[index].nombre;
                        this.reporteSel = index;
                        $('#verCom').modal('open')
                    } else {
                        this.pubSeleccionada=data[0];
                        this.razonSel = this.reportesP[index].razon;
                        this.detallesSel = this.reportesP[index].descripcion;
                        this.reportadoPor = this.reportesP[index].nombre;
                        this.reporteSel = index;
                        this.cargarMAterializeCss();
                        $('#verPub').modal('open');
                        
                    }
                    
                    
                    
                    
                    ;  
                          
            }catch(error){
                console.log(error);

            }

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
        cargarMaterializeCss: function(){
            $(document).ready(function() {
                $('.modal').modal();
                $('.tabs').tabs();
                $('.tooltipped').tooltip();
                $('.materialboxed').materialbox();
            });
        },
       
    },
    //al iniciar, carga la lista de usuarios
    created(){
        this.cargarMaterializeCss();
        this.cargarReportes(1);
        
    },





});