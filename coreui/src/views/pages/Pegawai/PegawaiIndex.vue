<template>
  <div class="wrapper">
    <CAlert :show.sync="showAlert" color="success" closeButton>
      {{ message }}
      <CButton
        class="position-absolute"
        color="secondary"
        style="right:10px;top: 50%;transform: translateY(-50%);"
        @click="showAlert = false"
      >
        Close
      </CButton>
    </CAlert>
    <div>
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
                      <CButton class ="mr-2" color="danger" @click="openModal(item.id)">Hapus</CButton>
                    </td>
                  </template>
              </CDataTable>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <div>
      <CModal
        title="Hapus Pegawai"
        :show.sync="hapusModal"
      >
        Apakah Anda yakin menghapus data pegawai ini?
        <template #footer>
          <CButton @click="hapusModal = false" color="secondary">Batalkan</CButton>
          <CButton @click="deletePegawai()" color="danger">Hapus</CButton>
        </template>
      </CModal>
    </div>
  </div>
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
      hapusModal: false,
      selectedPegawai: null,
      showAlert: false,
      message: '',
    }
  },
  
  methods: {
    getAllPegawai() {
      axios.get(this.$apiAdress + '/api/pegawai?token=' + localStorage.getItem('api_token')).then( r => {
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
    deletePegawai() {
      axios.delete(this.$apiAdress + '/api/pegawai/' + this.selectedPegawai + '?token=' + localStorage.getItem('api_token')).then( r => {
        this.getAllPegawai();
        this.hapusModal = false;
        this.showAlert = true;
        this.message = r.data.message;
      })
    },
    openModal(id) {
      this.selectedPegawai = id;
      this.hapusModal = true;
    }
  },
  mounted() {
    this.message = this.$route.query.message;
    if (this.message) {
      this.showAlert = true;
      this.$router.push('/pegawai');
    }
    this.getAllPegawai();
  }
}
</script>