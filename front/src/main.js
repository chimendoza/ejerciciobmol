
import "./assets/vendors/mdi/css/materialdesignicons.min.css";
import "./assets/vendors/css/vendor.bundle.base.css";
import "./assets/css/style.css";


import "./assets/vendors/js/vendor.bundle.base.js"
import "./assets/vendors/chart.js/Chart.min.js"
import "./assets/js/jquery.cookie.js"
import "./assets/js/off-canvas.js"
import "./assets/js/hoverable-collapse.js"
import "./assets/js/misc.js"
import "./assets/js/dashboard.js"
import "./assets/js/todolist.js"

import 'notivue/notification.css' // Only needed if using built-in <Notification />
import 'notivue/animations.css' // Only needed if using default animations



import { createApp} from 'vue'
import App from './App.vue'
import router from './router'
import { createNotivue } from 'notivue'


import SubmitButton from '@/components/SubmitButton.vue';
import FormControl from '@/components/FormControl.vue';


const bootstrapMixin={





    data(){

        return {
            isloading:false,
            issaving:false,
            editing:false,
            isretrieving:false,
            notification:null,
            model:{active:1},
            _errors:{},
            billing_cycles:[{'id':'daily','name':'Día','plural':'Días'},{'id':'monthly','name':'Mes','plural':'Meses'},{'id':'annualy','name':'Año','plural':'Años'}]
            
        }
        

    },
    methods:{


        


        formatDate(date,l) {
            let lang=l || 'es-ES';
            const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
            return date.toLocaleDateString(lang, options).replace(',', '');
        },

        cycleName(n,d){

            if(n){                
                let it=this.billing_cycles.find((e)=>(e.id==n));
                let r='';
                if(d>1){
                    r=d+' '+it.plural;
                }else{
                    r=it.name;
                }
                
                return r;
            }
            return '';
        },

        autolink(route){


            let r='';

            if(route!=undefined){
                r=route;
                if(route.indexOf('/')!=0){
                    r='/'+route;
                }
                
            }
            
            return this.$route.matched[0].path+r;

        },

        getBasePath(){
            
            return this.$route.matched[0].path;
        },


        getRequestPath(){

            let base_path=this.getBasePath();
            if(this.$route.matched[0].aliasOf){
                base_path=this.$route.matched[0].aliasOf.path;   
            }
            return base_path;
        },

        loadModel(){

            
            
            
            const params=this.$route.params;
            let api_path=this.getRequestPath();

            let id=params.id;

            this.isloading=true;


            
            if(id!=undefined){

                    api_path+='/'+id;
                    this.isretrieving=true;
                    this.editing=true;


                    
                    if(this.$route.query!=undefined){

                        
                        let query=[];
                        for(var q in this.$route.query){
                            query.push(q+'='+this.$route.query[q]);
                        }

                        let query_params=query.join('&');

                        api_path+='?'+query_params;

                    }

                    
                    this.$api.get(api_path).then(response=>{
                        
                        this.bindAttributes(response.data);

                                        
                        
                        if(this.onModelData!=undefined){
                            this.onModelData(response.data);
                        }

                    }).catch(error=>{                        
                        
                        console.log(error);
                    }).finally(()=>{

                        this.isretrieving=false;

                    });
            }
        },

        saveModel(){


            if(this.beforeSaveModel!=undefined){

                this.beforeSaveModel();

            }

            
            const params=this.$route.params;
            let base_path=this.getBasePath();
            let id=params.id;
            this.issaving=true;
            this.notification=this.$push.promise('Guardando...');


            let request_path=this.getRequestPath();

            //dependiendo de la existencia de id se determina si se crea el registro o se actualiza
            //la diferencia entre crea y actualiza es el método http usado será post o patch
            if(id!=undefined){
                request_path+='/'+id;
                this.updateModel(request_path);
            }else{
                this.createModel(request_path);
            }

            
        },



        createModel(request_path){

            
            
            let model=this.modelValue || this.model;

            if(model.trash==undefined){
                model.trash=0;
            }
            


            this.$api.post(request_path,model).then(response=>{

                this.notification.resolve('Datos guardados correctamente');

                if(this.onModelSaved!=undefined){
                    this.onModelSaved(true,response.data);
                }else{
                    this.$router.push(this.getBasePath());
                }               

            }).catch(error=>{
                this.notification.reject('Ocurrió un error al dar de alta');

                this.setErrors(error);
                if(this.onModelSaved!=undefined){
                    this.onModelSaved(false,error.data);
                }

            }).finally(()=>{

                this.issaving=false;
            });


        },
        updateModel(request_path){


            

            let model=this.modelValue || this.model;
            if(model.trash==undefined){
                model.trash=0;
            }

            this.$api.patch(request_path,model).then(response=>{


                this.notification.resolve('Cambios guardados correctamente');

                if(this.onModelSaved!=undefined){
                    this.onModelSaved(true,response.data);
                }else{
                    this.$router.push(this.getBasePath());
                }               

            }).catch(error=>{

                this.notification.reject('Ocurrió un problema guardando');

                
                this.setErrors(error);

                if(this.onModelSaved!=undefined){
                    this.onModelSaved(false,error.data);
                }

            }).finally(()=>{

                this.issaving=false;
            });


        },

        setErrors(error){
            let errors={};

            
            for(var e in error.response.data){

                
                errors[error.response.data[e].field]=error.response.data[e].message;

            }

        
            this.$parent._errors=errors;

            

        },

        deleteModel(id,route){



            let api_route;
            if(route==undefined || route.indexOf('?')!=-1){
                api_route=this.getRequestPath();

            }else{
                api_route=route;
            }


            if(confirm('¿Eliminar el registro?')){

                this.notification=this.$push.promise('Eliminando...');

                this.$api.delete(api_route+'/'+id).then(response=>{


                    this.notification=this.notification.resolve('Elemento eliminado');
                    if(this.onModelDelete!=undefined){
                        this.onModelDelete(true);
                    }else{

                        if(route!=undefined){
                            
                            if(this.items!=undefined){
                                this.items = this.items.filter(o => o.id !== id);
                            }

                        }   

                    }


                }).catch(error=>{

                    this.notification=this.notification.reject('No se pudo eliminar el elemento. '+error.message);
                    if(this.onModelDelete!=undefined){
                        this.onModelDelete(false);
                    }

                }).finally(()=>{



                });
            }

        },


        /***Función encargada de llenar todos los datos de la propiedad 'model' de un componente cuando este tenga la propiedad model*/
        bindAttributes(data){

            if(this.model!=undefined){
        
              for (const key in data) {
                if (this.model.hasOwnProperty(key) && data[key]) {
                    this.model[key] = data[key];
                }
  
                
              }
            }
  
          },

          save(){
            
            

          }

    }


}




import api from './util/api.js'



const app = createApp(App)

const notivue = createNotivue({avoidDuplicates: true});
app.use(notivue);
import { push } from 'notivue'
app.use(push);


app.use(router)

app.mixin(bootstrapMixin);

app.component('SubmitButton',SubmitButton);
app.component('FormControl',FormControl);


app.config.globalProperties.$api = api;


app.mount('#app')

