<template>
  <CRow>
    <CCol>
      <CInput
        label="Tipe"
        type="text"
        v-model="tipe"
        @change="changeTipe"
        invalid-feedback="Tipe tidak boleh kosong."
        :is-valid="tipe.length > 0"
        required
      />
    </CCol>
    <CCol>
      <CInput
        label="Nominal"
        type="number"
        @change="changeNominal"
        v-model="nominal"
        invalid-feedback="Nominal tidak boleh kosong."
        :is-valid="nominal > 0"
        @focus="$event.target.select()"
        required
        step="1000"
      />
    </CCol>
    <CCol sm="1" class="d-flex align-items-center">
      <CButton v-if="showHapus" color="primary" @click="hapusInput">Hapus</CButton>
    </CCol>
  </CRow>
</template>
<script>
export default {
  name: "IsiTagihan",
  data() {
    return {
      tipe: "",
      nominal: 0,
    };
  },
  props: ["inputId", "showHapus"],
  methods: {
    hapusInput() {
      this.$emit("hapusInput");
    },
    changeNominal() {
      this.$emit("changeNominal", { id: this.inputId, nominal: this.nominal });
    },
    changeTipe() {
      this.$emit("changeTipe", { id: this.inputId, tipe: this.tipe });
    },
  },
};
</script>