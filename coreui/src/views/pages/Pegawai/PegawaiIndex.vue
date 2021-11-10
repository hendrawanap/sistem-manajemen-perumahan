<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
        <div class="d-flex justify-content-between">
          <h2>Daftar Pegawai</h2>
          <router-link :to="'/pegawai/tambah'">
            <CButton color="primary">
              Tambah
            </CButton>
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
                  <router-link :to="'/pegawai/edit/'+item.id">
                    <CButton class ="mr-2" color="primary">Edit</CButton>
                  </router-link>
                  <CButton class ="mr-2" color="danger" @click="deletePegawai(item.id)">Hapus</CButton>
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
  name: "PegawaiIndex",
  title:'Daftar Pegawai',
  data() {
    return {
      items: [],
      fields: ['no.', 'Nama Pegawai', 'Gender', 'Alamat', 'Tanggal Masuk', 'Divisi', 'Jabatan', 'action'],
    }
  },
  
  methods: {
    getAllPegawai() {
      axios.get(this.$apiAdress + '/api/pegawai').then( r => {
        this.items = r.data.map((data, index) => {
          return {
          'no.': index+1,
          'Nama Pegawai': data.nama,
          'Gender': data.gender == 0 ? 'Laki-laki' : data.gender == 1 ? 'Perempuan' : 'null',
          'Alamat': data.alamat,
          'Tanggal Masuk': data.tanggalMasuk,
          'Divisi': data.divisi,
          'Jabatan': data.jabatan,
          'id': data.id,
        }});
      });
    },
    deletePegawai(id) {
      axios.get(this.$apiAdress + '/api/pegawai/delete/' + id).then( r => {
        this.getAllPegawai();
        console.log('berhasil menghapus');
      })
    },
  },
  mounted() {
    this.getAllPegawai();
  }
}
</script>