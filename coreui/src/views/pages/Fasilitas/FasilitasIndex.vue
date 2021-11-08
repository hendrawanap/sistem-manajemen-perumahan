<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div class="d-flex justify-content-between">
                        <h2>Daftar Fasilitas</h2>
                        <router-link :to="'/fasilitas/tambah'">
                        <CButton color="primary">Tambah</CButton>
                        </router-link>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CDataTable
                        hover
                        striped
                        :items="items"
                        :fields="fields"
                        :items-per-page="5"
                        pagination 
                        >
                        <template #action="{item}">                    
                            <td>
                                <router-link :to="'/fasilitas/edit/'+item.id">
                                <CButton color="primary" class="mr-2">Edit</CButton>
                                </router-link>
                                <CButton color="danger" @click="deleteFasilitas(item.id)">Hapus</CButton>
                            </td>
                        </template>
                    </CDataTable>
                </CCardBody>
            </CCard>
        </CCol> 
    </CRow>
</template>

<script>
import axios from 'axios'
export default{ 
    name: "FasilitasIndex",
    data() {
    return {
      items: [],
      fields: ['No.', 'Nama Fasilitas', 'Kondisi', 'Informasi', 'action'],
    }
  },
  methods: {
    getAllFasilitas() {
      axios.get(this.$apiAdress + '/api/fasilitas' + '?token=' + localStorage.getItem('api_token')).then( r => {
        this.items = r.data.map((data, index) => {
          return {
          'No.': index+1,
          'Nama Fasilitas': data.namaFasilitas,
          'Kondisi': data.kondisi,
          'Informasi': data.informasi,
          'id' : data.id,
        }});
      });
    },
    deleteFasilitas(id) {
        axios.get(this.$apiAdress + '/api/fasilitas/delete/' + id + '?token=' + localStorage.getItem('api_token')).then(R => {
            this.getAllFasilitas()
        })
    }
  },
  mounted() {
    this.getAllFasilitas();
  }
}
</script>
