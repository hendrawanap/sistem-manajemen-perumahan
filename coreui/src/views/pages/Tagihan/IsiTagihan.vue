<template>
  <CRow>
    <CCol>
      <CInput label="Tipe" type="text" v-model="tipe" @change="changeTipe"/>
    </CCol>
    <CCol>
      <CInput
        label="Nominal"
        type="number"
        @change="changeNominal"
        v-model="nominal"
      />
    </CCol>
    <CCol sm="1" class="d-flex align-items-center">
      <CButton color="primary" @click="hapusInput">Hapus</CButton>
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
  props: ["inputId"],
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