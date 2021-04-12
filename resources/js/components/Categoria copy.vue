<template>
        <!-- Main content -->
      <!-- Default box -->
      <main class="main">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categorías</h3>
          <button @click="abrirModal('categoria','registrar')" type="button" class="btn btn-secondary">
              <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
            <!--
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                </tr>
                <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2012/03/29</td>
                    <td>$433,060</td>
                </tr>
                <tr>
                    <td>Airi Satou</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>33</td>
                    <td>2008/11/28</td>
                    <td>$162,700</td>
                </tr>
                </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
-->





          <table class="display" style="width:100%" id="tabla">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 30%">
                          Nombre
                      </th>
                      <th style="width: 30%">
                          Descripción
                      </th>
                      <th style="width: 20%">
                          Estado
                      </th>
                      <th style="width: 19%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                      <td>
                          #
                      </td>
                      <td>
                          <a v-text="categoria.nombre">
                          </a>
                          <br/>
                          <small v-text="categoria.created_at">
                            Creado
                          </small>
                      </td>
                      <td v-text="categoria.descripcion">
                         
                      </td>
                      <td class="project-state">
                          <div v-if="categoria.condicion">
                              <span class="badge badge-success">Activo</span>
                          </div>
                          <div v-else>
                              <span class="badge badge-danger">Desactivado</span>
                          </div>
                      </td>
                      <td class="project-actions text-right">
                          <!--<a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              Ver
                          </a>
                          -->
                          <a class="btn btn-info btn-sm" href="#" @click="abrirModal('categoria','actualizar', categoria)">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                          <template v-if="categoria.condicion">
                            <a class="btn btn-danger btn-sm" href="#" @click="desactivarCategoria(categoria.id)">
                                <i class="fas fa-trash">
                                </i>
                                Eliminar
                            </a>
                          </template>
                          <template v-else>
                            <a class="btn btn-info btn-sm" href="#" @click="activarCategoria(categoria.id)">
                                <i class="fas fa-check">
                                </i>
                                Activar
                            </a>
                          </template>
                      </td>
                  </tr>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->


        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" :class="{'mostrar' : modal}" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csfr
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="descripcion" class="form-control" placeholder="Descripción Categoria">
                                </div>
                            </div>
                            <div v-show="errorCategoria" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                    </div>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->

        </div>
        <!--Fin del modal-->
      </main>

      
</template>

<script>
    export default {
        data (){
            return {
                categoria_id: 0, //Para la actualización
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0, //Para mostrar u ocultar modal
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria :0,
                errorMostrarMsjCategoria : []
            }
        },
        methods : {
            tablas (){
                alert(9197);
                /*this.$nextTick(() => {
                    $('#example').DataTable();
                });
                */
            },
            listarCategoria (){
                let me = this;
                axios.get('/categoria').then(function (response) {
                    me.arrayCategoria = response.data;
                    //$('#tabla').DataTable();
                    /*
                    this.$nextTick(() => {
                        $('#tabla').DataTable();
                    });
*/
                     this.$nextTick(() => {
          alert(11);
      });
                
                    console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            registrarCategoria (){
                if(this.validarCategoria()){
                    return;
                }

                let me = this;
                axios.post('/categoria/registrar', {
                    'nombre' : this.nombre,   //Datos a insertar
                    'descripcion' : this.descripcion //Datos a insertar
                }).then(function (response) {
                   me.cerrarModal();
                   me.listarCategoria();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            actualizarCategoria(){
                if(this.validarCategoria()){
                    return;
                }

                let me = this;
                axios.put('/categoria/actualizar', {
                    'id' : this.categoria_id,
                    'nombre' : this.nombre,   //Datos a insertar
                    'descripcion' : this.descripcion //Datos a insertar
                }).then(function (response) {
                   me.cerrarModal();
                   me.listarCategoria();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            desactivarCategoria(id){
                Swal.fire({
                title: '¿Está seguro de desactivar ésta categoría?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let me = this;
                        axios.put('/categoria/desactivar', {
                            'id' : id
                        }).then(function (response) {
                        me.listarCategoria();                   
                        Swal.fire(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito',
                        'success'
                        )
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }
                })
            },
            activarCategoria(id){
                Swal.fire({
                title: '¿Está seguro de activar ésta categoría?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let me = this;
                        axios.put('/categoria/activar', {
                            'id' : id
                        }).then(function (response) {
                        me.listarCategoria();                   
                        Swal.fire(
                        'Activada!',
                        'El registro ha sido activado con éxito',
                        'success'
                        )
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }
                })
            },
            validarCategoria(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria = [];

                if (!this.nombre) this.errorMostrarMsjCategoria.push("El nombre de la categoría no puede estar vacio");

                if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.descripcion = '';
            },

            abrirModal(modelo, accion, data = []){ //data = [] Declara array vacio
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                console.log('trgidd')
                                this.modal = 1; // mostrar modal
                                this.tituloModal = 'Registra Categoría';
                                this.nombre = '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Categoría';
                                this.categoria_id = data['id'];
                                this.nombre = data['nombre']; //Acceder a los datos del objeto
                                this.descripcion = data['descripcion']; //Acceder a los datos del objeto
                                 this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
            this.listarCategoria();
        },
    }
</script>
<style>
    .modal-content{ 
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display : flex;
        justify-content : center;
    }
    .text-error{
        color:red !important;
        font-weight: bold;
    }
</style>
