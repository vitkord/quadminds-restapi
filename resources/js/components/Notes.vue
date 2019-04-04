<template>
	<div>
		<h2 class="text-center">Notas</h2>

		<form @submit.prevent="addNote" class="mb-3">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Titulo" v-model="note.title">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Contenido" v-model="note.content">
			</div>
			<div class="col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Enviar</button>
			</div>
		</form>

		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchNotes(pagination.next_page_url)">Anterior</a></li>
		    
		    <li class="page-item disabled"><a class="page-link text-dark" href="#">Pagina {{ pagination.current_page}} de {{ pagination.last_page }}</a></li>

		    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchNotes(pagination.next_page_url)">Siguiente</a></li>
		  </ul>
		</nav>

		<div class="card card-body mb-2 text-center" v-for="note in notes" v-bind:key="note.id">
			<h3>{{ note.title  }}</h3>
			<p>{{ note.content }}</p>
			<hr>
			<div class="col-md-12">
				<button @click="editNote(note)" class="btn btn-warning"> Editar </button>
				<button @click="deleteNote(note.id)" class="btn btn-danger"> Eliminar </button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				notes: [],
				note:{
					id: '',
					title: '',
					content: ''
				},
				note_id: '',
				pagination: {},
				edit: false,

			}
		},

		created() {
			this.fetchNotes();
		},

		methods:{
			fetchNotes(page_url) {
				let vm = this;
				page_url = page_url || 'api/notes'
				fetch(page_url)
					.then(response => response.json())
					.then(response => {
						this.notes = response.data;
						vm.makePagination(response.meta, response.links);
					})
					.catch(error => console.log(error));
			},
			makePagination(meta, links) {
				let pagination = {
					current_page: meta.current_page,
					last_page: meta.last_page,
					next_page_url: links.next,
					prev_page_url: links.prev
				}
				this.pagination = pagination;
			},
			deleteNote(id){
				if (confirm('¿ Estas Seguro ?')) {
					fetch(`api/notes/${id}`, {
						method: 'delete'
					})
					.then(response => response.json())
					.then(data => {
						alert('Nota Removida');
						this.fetchNotes();
					})
					.catch(error => console.log(error))
				}
			},
			addNote(){
				if (this.edit === false) {
					//agregamos
					fetch('api/notes',{
						method: 'post',
						body: JSON.stringify(this.note),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(response => response.json())
					.then(data => {
						this.note.title = '';
						this.note.content= '';
						alert('Nota Agregada');
						this.fetchNotes();
					})
					.catch(error => console.log(error))
				}
				else
				{
					//editamos
					fetch('api/notes/',{
						method: 'put',
						body: JSON.stringify(this.note),
						headers: {
							'content-type': 'application/json'
						}
					})
					.then(response => response.json())
					.then(data => {
						this.note.title = '';
						this.note.content = '';
						this.note.note_id = '';
						alert('Nota Modificada');
						this.fetchNotes();
						this.edit = false;
					})
					.catch(error => console.log(error))
				}
			},
			editNote(note) {
				this.edit = true;
				this.note.id = note.id;
				this.note.note_id = note.id;
				this.note.title = note.title;
				this.note.content = note.content;
			}
		}
	}
</script>