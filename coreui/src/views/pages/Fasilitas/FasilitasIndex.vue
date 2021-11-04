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
                                <CButton color="primary">Edit</CButton>
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
export default{ 
    name: "KKIndex",
    data() {
    return {
      items: [],
      fields: ['No.', 'Nama Fasilitas', 'Kondisi', 'Informasi', 'action'],
    }
  },
  methods: {
    getAllFasilitas() {
      axios.get(this.$apiAdress + '/api/Fasilitas').then( r => {
        this.items = r.data.map((data, index) => {
          return {
          'no.': index+1,
          'Nama Fasilitas': data.fasilitas,
          'Kondisi': data.kondisi,
          'Informasi': data.informasi,
          'id' : data.id,
        }});
      });
    },
    deleteFasilitas(id) {
        axios.get(this.$apiAdress + '/api/fasilitas/delete/' + id).then(R => {
            this.getAllFasilitas()
        })
    }
  },
  mounted() {
    this.getAllFasilitas();
  }
}
</script>
