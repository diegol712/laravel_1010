<template>
        <!-- Main content -->
      <!-- Default box -->
      <main class="main">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categorías</h3>
          <button type="button" class="btn btn-secondary" @click="abrirModal('categoria','registrar')">
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
                          <a class="btn btn-info btn-sm" href="#" >
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Eliminar
                            </a>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-check">
                                </i>
                                Activar
                            </a>
                      </td>
                  </tr>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->


        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" :class="{'mostrar' : modal}" aria-hidden="true" >
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" ></h4>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                               <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Nombre de categoría">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="Descripción Categoria">
                                </div>
                            </div>
                            <div class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div>

                                    </div>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Cerrar</button>
                        <button type="button" class="btn btn-primary" >Guardar</button>
                        <button type="button" class="btn btn-primary" >Actualizar</button>
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
                arrayCategoria : [],
                modal : 0,
                tituloModal : 'Registrar Categoría',
                nombre : '',
                descripcion : '',
                tipoAccion : 1
            }
        },
        methods : {
            listarCategoria (){
                let me = this;
                // Make a request for a user with a given ID
                axios.get('/categoria').then(response => {
                    me.arrayCategoria = response.data;
                    this.tabla();
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
            tabla (){
                this.$nextTick(() => {
                    $('#tabla').DataTable();
                });
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        console.log('abrir modal');
                        this.modal = 1;
                        this.tituloModal = 'Registrar Categoría';
                        this.nombre = '';
                        this.descripcion = '';
                        this.tipoAccion = 1;
                        break;
                    }
                }
            }
        },
        mounted() {
            console.log('Construyendo el Componente');
            this.listarCategoria();
        },
    }
</script>
<style>
    .mostrar{
        display: list-item impo !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: red;
    }
</style>