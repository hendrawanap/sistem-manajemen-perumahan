<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar KK</h2>
            <router-link :to="'/KK/tambah'">
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
            pagination>
            <template #action="{item}">
              <td>
                <router-link :to="'/KK/edit/'+item.id">
                <CButton color="primary" class="mr-2">Edit</CButton>
                </router-link>
                <CButton color="danger" @click="deleteKK(item.id)">Hapus</CButton>
              </td>
            </template>
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios';
export default {
  name: "KKIndex",
  title:'Daftar KK',
  data() {
    return {
      items: [],
      fields: ['no.', 'nomor KK', 'alamat', 'kepala Keluarga', 'action'],
    }
  },
  methods: {
    getAllKK() {
      axios.get(this.$apiAdress + '/api/KK').then( r => {
        this.items = r.data.map((data, index) => {
          return {
          'no.': index+1,
          'nomor KK': data.nomorKK,
          'alamat': data.alamat,
          'kepala Keluarga': data.kepalaKeluarga,
          'id' : data.id,
        }});
      });
    },
    deleteKK(id) {
        axios.get(this.$apiAdress + '/api/KK/delete/' + id).then(R => {
            this.getAllKK()
        })
    }
  },
  mounted() {
    this.getAllKK();
  }
}
</script>