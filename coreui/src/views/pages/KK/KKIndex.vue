<template>
  <div class="wrapper">
    <CAlert :show.sync="showAlert" color="success" closeButton>
      {{ message }}
      <CButton
        class="position-absolute"
        color="secondary"
        style="right: 10px; top: 50%; transform: translateY(-50%)"
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
                pagination
              >
                <template #action="{ item }">
                  <td>
                    <router-link :to="'/KK/edit/' + item.id">
                      <CButton color="primary" class="mr-2">Edit</CButton>
                    </router-link>
                    <CButton
                      class="mr-2"
                      color="danger"
                      @click="openModal(item.id)"
                      >Hapus</CButton
                    >
                  </td>
                </template>
              </CDataTable>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <div>
      <CModal title="Hapus KK" :show.sync="hapusModal">
        Apakah Anda yakin menghapus data KK ini?
        <template #footer>
          <CButton @click="hapusModal = false" color="secondary"
            >Batalkan</CButton
          >
          <CButton @click="deleteKK()" color="danger">Hapus</CButton>
        </template>
      </CModal>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "KKIndex",
  title: "Daftar KK",
  data() {
    return {
      items: [],
      fields: ["no.", "nomor KK", "alamat", "kepala Keluarga", "action"],
      hapusModal: false,
      selectedKK: null,
      showAlert: false,
      message: "",
    };
  },
  methods: {
    getAllKK() {
      axios
        .get(
          this.$apiAdress + "/api/kk?token=" + localStorage.getItem("api_token")
        )
        .then((r) => {
          this.items = r.data.map((data, index) => {
            return {
              "no.": index + 1,
              "nomor KK": data.nomorKK,
              alamat: data.alamat,
              "kepala Keluarga": data.kepalaKeluarga,
              id: data.id,
            };
          });
        });
    },
    deleteKK() {
      axios
        .delete(
          this.$apiAdress +
            "/api/kk/" +
            this.selectedKK +
            "?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.getAllKK();
          this.hapusModal = false;
          this.showAlert = true;
          this.message = r.data.message;
        });
    },
    openModal(id) {
      this.selectedKK = id;
      this.hapusModal = true;
    },
  },
  mounted() {
    this.message = this.$route.query.message;
    if (this.message) {
      this.showAlert = true;
      this.$router.push("/KK");
    }
    this.getAllKK();
  },
};
</script>