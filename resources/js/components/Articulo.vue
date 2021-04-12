<template>
        <!-- Main content -->
      <!-- Default box -->
      <main class="main">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Artículos</h3>
          <button @click="abrirModal('articulo','registrar')" type="button" class="btn btn-secondary">
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
                          Código
                      </th>
                      <th style="width: 20%">
                          Nombre
                      </th>
                       <th style="width: 10%">
                          Categoría
                      </th>
                       <th style="width: 5%">
                          Precio Venta
                      </th>                      
                       <th style="width: 5%">
                          Stock
                      </th>
                      <th style="width: 30%">
                          Descripción
                      </th>
                      <th style="width: 10%">
                          Estado
                      </th>
                      <th style="width: 19%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="articulo in arrayArticulo" :key="articulo.id">
                      <td v-text="articulo.codigo">
                          
                      </td>
                      <td>
                          <a v-text="articulo.nombre">
                          </a>
                          <br/>
                          <small v-text="articulo.created_at">
                            Creado
                          </small>
                      </td>
                       <td v-text="articulo.nombre_categoria"></td>
                       <td v-text="articulo.precio_venta"></td>
                       <td v-text="articulo.stock"></td>
                      <td v-text="articulo.descripcion"></td>

                      <td class="project-state">
                          <div v-if="articulo.condicion">
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
                          <a class="btn btn-info btn-sm" href="#" @click="abrirModal('articulo','actualizar', articulo)">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                          <template v-if="articulo.condicion">
                            <a class="btn btn-danger btn-sm" href="#" @click="desactivarArticulo(articulo.id)">
                                <i class="fas fa-trash">
                                </i>
                                Eliminar
                            </a>
                          </template>
                          <template v-else>
                            <a class="btn btn-info btn-sm" href="#" @click="activarArticulo(articulo.id)">
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
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Categoría</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idcategoria">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Código</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="codigo" class="form-control" placeholder="Código de barras">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de artículo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Precio Venta</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="precio_venta" class="form-control" placeholder="Precio de Venta">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Stock</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="stock" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="descripcion" class="form-control" placeholder="Descripción Categoria">
                                </div>
                            </div>
                            <div v-show="errorArticulo" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjArticulo" :key="error" v-text="error">

                                    </div>
                                </div>
                            
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarArticulo()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarArticulo()">Actualizar</button>
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
                articulo_id : 0, //Para la actualización
                idcategoria : 0,
                nombre_categoria : '',
                codigo : '',
                nombre : '',
                precio_venta : 0,
                stock : 0,
                descripcion : '',
                arrayArticulo : [],
                modal : 0, //Para mostrar u ocultar modal
                tituloModal : '',
                tipoAccion : 0,
                errorArticulo :0,
                errorMostrarMsjArticulo : [],
                arrayCategoria : []
            }
        },
        methods : {
            tabla(){
                this.$nextTick(() => {
                    $('#tabla').DataTable();
                });
                
            },
            listarArticulo (){
                let me = this;
                axios.get('/articulo').then(response => {
                    me.arrayArticulo = response.data
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
            selectCategoria (){
                let me = this;
                let url = '/categoria/selectCategoria';
                axios.get(url).then(response => {
                    let respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
                    //console.log(respuesta.categorias);
                })
               .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            },
            registrarArticulo (){
                if(this.validarArticulo()){
                    return;
                }

                let me = this;
                axios.post('/articulo/registrar', {
                    'idcategoria' : this.idcategoria,
                    'codigo' : this.codigo,
                    'nombre' : this.nombre,   //Datos a insertar
                    'stock' : this.stock,
                    'precio_venta' : this.precio_venta,
                    'descripcion' : this.descripcion //Datos a insertar
                }).then(function (response) {
                   me.cerrarModal();
                   me.listarArticulo();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            actualizarArticulo(){
                if(this.validarArticulo()){
                    return;
                }

                let me = this;
                axios.put('/articulo/actualizar', {
                    'id' : this.articulo_id,
                    'idcategoria' : this.idcategoria,
                    'codigo' : this.codigo,
                    'nombre' : this.nombre,   //Datos a insertar
                    'stock' : this.stock,
                    'precio_venta' : this.precio_venta,
                    'descripcion' : this.descripcion //Datos a insertar
                }).then(function (response) {
                   me.cerrarModal();
                   me.listarArticulo();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            desactivarArticulo(id){
                Swal.fire({
                title: '¿Está seguro de desactivar éste artículo?',
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
                        axios.put('/articulo/desactivar', {
                            'id' : id
                        }).then(function (response) {
                        console.log("---------------"+id+"oooooooooooooooooooooooooo");
                        me.listarArticulo();                   
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
            activarArticulo(id){
                Swal.fire({
                title: '¿Está seguro de activar éste artículo?',
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
                        axios.put('/articulo/activar', {
                            'id' : id
                        }).then(function (response) {
                        me.listarArticulo();                   
                        Swal.fire(
                        'Activado!',
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
            validarArticulo(){
                this.errorArticulo=0;
                this.errorMostrarMsjArticulo = [];

                if (!this.idcategoria) this.errorMostrarMsjArticulo.push("Seleccione una categoría");
                if (!this.nombre) this.errorMostrarMsjArticulo.push("El nombre del artículo no puede estar vacio");
                if (!this.stock) this.errorMostrarMsjArticulo.push("El stock del artículo debe ser un número y no puede estar vacio");
                if (!this.precio_venta) this.errorMostrarMsjArticulo.push("El precio de venta debe ser un número y no puede estar vacio");

                if (this.errorMostrarMsjArticulo.length) this.errorArticulo = 1;

                return this.errorArticulo
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.idcategoria = 0;
                this.nombre_categoria = '';
                this.codigo = '';
                this.nombre = '';
                this.precio_venta = 0;
                this.stock = 0;
                this.descripcion = '';
                this.errorArticulo = 0;
            },

            abrirModal(modelo, accion, data = []){ //data = [] Declara array vacio
                switch(modelo){
                    case "articulo":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1; // mostrar modal
                                this.tituloModal = 'Registrar Artículo';
                                this.idcategoria = 0;
                                this.nombre_categoria = '';
                                this.codigo = '';
                                this.nombre = '';
                                this.precio_venta = 0;
                                this.stock = 0;
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Artículo';
                                this.articulo_id = data['id'];
                                this.idcategoria = data['idcategoria'];
                                this.codigo = data['codigo'];
                                this.nombre = data['nombre']; //Acceder a los datos del objeto
                                this.stock = data['stock'];
                                this.precio_venta = data['precio_venta']
                                this.descripcion = data['descripcion']; //Acceder a los datos del objeto
                                 this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
                this.selectCategoria();
            },
        },
        mounted() {
            this.listarArticulo();
        },
    }
</script>
<style>
    .modal-content{ 
        width: 100% !important;
        margin-top:55px;
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