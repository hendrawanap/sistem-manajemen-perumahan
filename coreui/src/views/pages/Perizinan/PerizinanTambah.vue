<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Tambah Perizinan</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm class="position-relative" @submit="submit">
            <CInput
              label="Nama Pegawai"
              type="text"
              v-model="searchQuery"
              @focus="onFocus"
              @blur="onBlur"
              invalid-feedback="Nama pegawai tidak boleh kosong."
              :is-valid="searchQuery.length > 0"
              required
            />
            <CCard class="dropdown-list shadow-sm" v-show="focused">
              <CListGroup flush>
                <CListGroupItem
                  class="dropdown-item"
                  v-for="pegawai in resultQuery"
                  :key="'pegawai-' + pegawai.id"
                  @click="setSelectedPegawai(pegawai)"
                >
                  {{ pegawai.nama }}
                </CListGroupItem>
              </CListGroup>
            </CCard>
            <CInput
              label="Tanggal"
              type="date"
              v-model="perizinan.tanggal"
              invalid-feedback="Tanggal perizinan tidak boleh kosong."
              :is-valid="perizinan.tanggal != null"
              required
            />
            <CSelect
              label="Tipe Perizinan"
              :options="tipeOptions"
              :value.sync="perizinan.tipe"
              placeholder="Pilih Tipe"
              invalid-feedback="Tipe perizinan tidak boleh kosong."
              :is-valid="perizinan.tipe.length > 0"
              required
            />
            <CInput
              label="Alasan"
              type="text"
              v-model="perizinan.alasan"
              invalid-feedback="Alasan perizinan tidak boleh kosong."
              :is-valid="perizinan.alasan.length > 0"
              required
            />
            <CButton type="submit" color="primary">
              Submit
            </CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import axios from "axios";

export default {
  name: "PerizinanTambah",
  title:'Tambah Perizinan',
  data() {
    return {
      perizinan: {
        idPegawai: "",
        tanggal: null,
        alasan: "",
        tipe: "",
      },
      tipeOptions: ["Sakit", "Izin"],
      daftarPegawai: [],
      searchQuery: '',
      selectedPegawai: null,
      focused: false,
    };
  },
  methods: {
    submit(e) {
      e.preventDefault();
      const formData = new FormData();
      const perizinan = this.perizinan;
      formData.append('idPegawai', perizinan.idPegawai);
      formData.append('tipePerizinan', perizinan.tipe);
      formData.append('alasan', perizinan.alasan);
      formData.append('tanggalIzin', perizinan.tanggal + ' 00:00:00');
      
      axios.post(this.$apiAdress + '/api/perizinan?token=' + localStorage.getItem('api_token'), formData)
        .then(r => {
          console.log(r.data.status);
          this.$router.push('/perizinan');
        });
    },
    fetchDaftarPegawai() {
      axios
        .get(
          this.$apiAdress +
            "/api/pegawai?token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          this.daftarPegawai = r.data;
        });
    },
    setSelectedPegawai(pegawai) {
      this.selectedPegawai = pegawai;
      this.searchQuery = pegawai.nama;
      this.perizinan.idPegawai = pegawai.id;
    },
    onFocus() {
      this.focused = true;
    },
    onBlur() {
      setTimeout(() => {
        this.focused = false;
      }, 100);
    },
  },
  computed: {
    resultQuery() {
      if (this.searchQuery) {
        return this.daftarPegawai.filter((item) => {
          return this.searchQuery
            .toLowerCase()
            .split(" ")
            .every((v) => item.nama.toLowerCase().includes(v));
        });
      } else {
        return this.daftarPegawai;
      }
    },
  },
  mounted() {
    this.fetchDaftarPegawai();
  }
};
</script>

<style scoped>
.dropdown-list {
  position: absolute;
  top: 70px;
  max-height: 200px;
  overflow: auto;
  left: 0;
  right: 0;
  z-index: 10;
}
.dropdown-item:hover {
  color: white;
  background-color: rgb(82, 82, 94);
  cursor: pointer;
}
</style>
