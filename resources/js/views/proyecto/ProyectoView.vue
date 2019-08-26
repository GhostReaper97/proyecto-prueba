<template>
    <div class="card card-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h2>Administracion de Proyectos</h2>
                </div>
                <div class="col-md-2">
                    <button @click="Nuevo()" class="btn btn-primary btn-block">Crear nuevo +</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Califacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <modal-template id="proyecto" size="modal-lg">
            <template slot="titulo">
                Nuevo
            </template>
            <template slot="contenido">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Datos del proyecto</h5>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inlineFormInputGroup">Nombre</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                                </div>
                                <input v-model="nombre" type="text" class="form-control"  placeholder="Ingrese el nombre">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inlineFormInputGroup">Calificacion</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                                </div>
                                <select v-model="calificacion" class="form-control">
                                    <option :value="cal.value" :key="index" v-for="(cal, index) of calificaciones">
                                        {{ cal.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inlineFormInputGroup">Descripcion</label>
                            <div class="input-group mb-2">
                                <textarea v-model="descripcion" rows="5" placeholder="Ingrese la descripcion" class="form-control"></textarea>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </template>
            <template slot="botones">

            </template>
        </modal-template>

    </div>
</template>

<script>
export default {
    data(){
        return {

            esNuevo : false,

            id : "",
            nombre : "",
            descripcion : "",
            calificacion : "",

            calificaciones : [
                {
                    name : "Seleccione una calificacion",
                    value : null
                },
                {
                    name : "5",
                    value : 5
                },
                {
                    name : "6",
                    value : 6
                },
                {
                    name : "7",
                    value : 7
                },
                {
                    name : "8",
                    value : 8
                },
                {
                    name : "9",
                    value : 9
                },
                {
                    name : "10",
                    value : 10
                }
            ],

            errores : [],

        }
    },

    methods : {

        limpiarCampos(){

            this.id = "";
            this.nombre = "";
            this.descripcion = "";
            this.calificacion = "";

        },

        Nuevo(){

            if(!this.esNuevo){

                this.limpiarCampos();
                this.esNuevo = true;

            }

            $("#proyecto").modal();

        }

    },

    created(){



    }

}
</script>