<template>
    <div class="card card-catalogo">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <h2>Administracion de Integrantes</h2>
                </div>
                <div class="col-md-2">
                    <button @click="Nuevo()" class="btn btn-primary btn-block">Crear nuevo +</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="index" v-for="(integrante, index) of listaIntegrantes">
                                <td> {{ integrante.nombres }} </td>
                                <td> {{ integrante.apellidos }} </td>
                                <td> {{ integrante.email }} </td>        
                                <td> 
                                    <button @click="Editar(integrante.id)" class="btn btn-outline-dark btn-sm "  data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline-dark btn-sm " data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-outline-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Asignar proyecto"><i class="fa fa-edit"></i></button>
                                </td>        
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <modal-template id="proyecto" size="modal-xl">
            <template slot="titulo">

            </template>
            <template slot="contenido">

            </template>
            <template slot="botones">

            </template>
        </modal-template>

        <modal-template id="catalogo" size="modal-lg">
            <template slot="titulo">
                Nuevo
            </template>
            <template slot="contenido">
                
                <div class="row">
                    <div class="col-md-12">
                        <h5>Datos del integrante</h5>
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
                            <span v-if="errores.nombres" class="error-validacion"> {{ errores.nombres[0] }} </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inlineFormInputGroup">Apellidos</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                                </div>
                                <input v-model="apellido" type="text" class="form-control"  placeholder="Ingrese los apellidos">
                            </div>
                            <span v-if="errores.apellidos" class="error-validacion"> {{ errores.apellidos[0] }} </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inlineFormInputGroup">Correo Electronico</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                                </div>
                                <input v-model="email" type="text" class="form-control"  placeholder="Ingrese el correo electronico">
                                
                            </div>
                            <span v-if="errores.email" class="error-validacion"> {{ errores.email[0] }} </span>
                        </div>
                    </div>
                </div>

            </template>
            <template slot="botones">
                <button v-if="esNuevo"  @click="CrearIntegrante()" class="btn btn-primary">Crear </button>
                <button v-else class="btn btn-primary">Actualizar</button>
            </template>
        </modal-template>
    </div>
</template>

<script>
export default {
    
    data(){
        return{

            esNuevo : true,

            id : "",

            nombre : "",
            apellido : "",
            email : "",

            listaIntegrantes : [],

            errores : [],

        }
    },

    methods : {

        LimpiarCampos(){

            this.id = "";
            this.nombre = "";
            this.apellido = "";
            this.email = "";

        },

        Nuevo(){

            if(!this.esNuevo){

                this.LimpiarCampos();
                this.esNuevo = true;
                this.errores = [];

            }

            $("#catalogo").modal();

        },

        CrearIntegrante(){

            let json = {
                nombres : this.nombre,
                apellidos : this.apellido,
                email : this.email
            };

            axios.post(
                'integrante/crear',
                {"json" : JSON.stringify(json)}
            ).then( (res) => {

                this.ListarIntegrantes();

            }).catch( (error) => {

                if(error.response.data.mensaje == "error_validacion")
                    this.errores = error.response.data.errores;

            });

        },

        Editar(id){

            

            axios.get(
                'integrante/buscar/' + id
            ).then( (res) => {

                this.esNuevo = false;
                this.nombre = res.data.nombres;
                this.apellido = res.data.apellidos;
                this.email = res.data.email;
                this.id = res.data.id;

                $("#catalogo").modal();

            });

        },



        ListarIntegrantes(){

            axios.get(
                'integrante/listar'
            ).then( (res) => {

                this.listaIntegrantes = res.data;

            });

        }

    },

    created(){

        this.ListarIntegrantes();

    }

}
</script>