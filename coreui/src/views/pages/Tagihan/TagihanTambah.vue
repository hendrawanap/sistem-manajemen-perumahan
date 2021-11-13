<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Tambah Tagihan</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm @submit="tambahTagihan">
            <CInput
              label="Nama Tagihan"
              type="text"
              v-model="tagihan.namaTagihan"
              invalid-feedback="Nama tagihan tidak boleh kosong."
              :is-valid="tagihan.namaTagihan.length > 0"
              required
            />
            <CInput
              label="Tanggal"
              type="date"
              v-model="tagihan.tanggalTagihan"
              invalid-feedback="Nama tagihan tidak boleh kosong."
              :is-valid="tagihan.tanggalTagihan != null"
              required
            />
            Rincian
            <CCard>
              <CCardBody>
                <IsiTagihan
                  v-for="input in inputs"
                  :key="'input-' + input.id"
                  @changeNominal="changeNominal"
                  @changeTipe="changeTipe"
                  @hapusInput="() => hapusInput(input.id)"
                  :inputId="input.id"
                  :showHapus="showHapus"
                />
                <CButton color="primary" @click="tambahInput()">
                  Tambah
                </CButton>
              </CCardBody>
            </CCard>
            <CInput label="Total Tagihan" disabled v-model="total" />
            <CButton type="submit" color="primary"
              >Submit</CButton
            >
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
import IsiTagihan from "./IsiTagihan";
export default {
  components: {
    IsiTagihan,
  },
  name: "TagihanTambah",
  title: 'Tambah Tagihan',
  data() {
    return {
      tagihan: {
        namaTagihan: "",
        tanggalTagihan: null,
      },
      inputs: [
        {
          tipe: "",
          nominal: 0,
          id: 0,
        },
      ],
      counts: 1,
      total: 0,
      showHapus: false,
    };
  },
  methods: {
    tambahInput() {
      this.inputs.push({
        tipe: "",
        nominal: 0,
        id: this.counts + 1,
      });
      this.counts += 1;
      this.showHapus = this.inputs.length > 1;
    },
    hapusInput(id) {
      this.inputs = this.inputs.filter((input) => input.id != id);
      this.hitungTotal();
      this.showHapus = this.inputs.length > 1;
    },
    hitungTotal() {
      this.total = this.inputs
        .map((input) => input.nominal)
        .reduce((total, nominal) => total + nominal);
    },
    changeNominal(masukan) {
      const index = this.inputs.findIndex((input) => input.id == masukan.id);
      this.inputs[index].nominal = parseInt(masukan.nominal);
      this.hitungTotal();
    },
    changeTipe(masukan) {
      const index = this.inputs.findIndex((input) => input.id == masukan.id);
      this.inputs[index].tipe = masukan.tipe;
    },
    tambahTagihan(e) {
      e.preventDefault();
      const formData = new FormData();
      formData.append("namaTagihan", this.tagihan.namaTagihan);
      formData.append("tanggalTagihan", this.tagihan.tanggalTagihan);
      formData.append("rincian", JSON.stringify(this.inputs));
      axios
        .post(
          this.$apiAdress +
            "/api/tagihan?token=" +
            localStorage.getItem("api_token"),
          formData
        )
        .then((r) => {
          this.$router.push("/tagihan");
        });
    },
  },
  computed: {},
};
</script>