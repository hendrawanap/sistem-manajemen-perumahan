<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar Pembayaran</h2>
          </div>
          <div>
            <CInput
              label="Search KK"
              placeholder="Cari nama kepala keluarga, atau no kk"
              type="text"
              id="searchKK"
            />
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
            <template #Aksi="{ item }">
              <td>
                <router-link :to="'/tagihan/detail/' + item.id">
                  <CIcon name="cil-info" />
                </router-link>
              </td>
            </template>
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
<script>
import axios from "axios";
export default {
  name: "DaftarPembayaran",
  title:'Daftar Pembayaran',
  data() {
    return {
      items: [
        {
          "No.": "1",
          "Nomor KK": 188123812388123,
          "Tanggal Bayar": "3-11-2021",
          Tagihan: "Air",
        },
        {
          "No.": "2",
          "Nomor KK": 188123812388123,
          "Tanggal Bayar": "3-11-2021",
          Tagihan: "Bumi",
        },
      ],
      fields: ["No.", "Nomor KK", "Tanggal Bayar", "Tagihan", "Aksi"],
    };
  },
};
</script>
