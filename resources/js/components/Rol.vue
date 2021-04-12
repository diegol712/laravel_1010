<template>
        <!-- Main content -->
      <!-- Default box -->
      <main class="main">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Roles</h3>
                
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
                   </tr>
              </thead>
              <tbody>
                  <tr v-for="rol in arrayRol" :key="rol.id">
                      <td>
                          #
                      </td>
                      <td>
                          <a v-text="rol.nombre">
                          </a>
                          <br/>
                          <small v-text="rol.created_at">
                            Creado
                          </small>
                      </td>
                      <td v-text="rol.descripcion">
                         
                      </td>
                      <td class="project-state">
                          <div v-if="rol.condicion">
                              <span class="badge badge-success">Activo</span>
                          </div>
                          <div v-else>
                              <span class="badge badge-danger">Desactivado</span>
                          </div>
                      </td>
                  </tr>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->


      </div>
      <!-- /.card -->
      </main>

      
</template>

<script>
    export default {
        data (){
            return {
                arrayRol : [],
            }
        },
        methods : {
            tabla(){
                this.$nextTick(() => {
                    $('#tabla').DataTable();
                });
                
            },
            listarRol (){
                let me = this;
                axios.get('/rol').then(response => {
                    me.arrayRol = response.data
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
        },
        mounted() {
            this.listarRol();
        },
    }
</script>