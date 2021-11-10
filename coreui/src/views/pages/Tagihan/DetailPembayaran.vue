<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Detail Pembayaran</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput disabled label="No KK" type="text" />
            <CInput disabled label="Tanggal" type="date" />
            <CInput disabled label="Nama Pembayar" type="text" />
            <CInput disabled label="Detail Pembayaran" type="text" />
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
  components: {},
  name: "DetailPembayaran",
  title: 'Detail Pembayaran',
  data() {
    return {};
  },
};
</script>