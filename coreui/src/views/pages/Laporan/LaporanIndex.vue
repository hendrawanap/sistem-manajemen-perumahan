<template>
  <div class="wrapper">
    <div>
      <CRow>
        <CCol>
          <CCard>
            <CCardHeader>
              <div class="d-flex justify-content-between">
                <h2>Laporan</h2>
                <CButton @click="infoModal = !infoModal" color="primary">
                  Generate Laporan
                </CButton>
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
                <template #show="{item}">
                    <td>
                    <router-link :to="item.link">
                        <CButton color="primary">Check</CButton>
                    </router-link>
                    </td>
                 </template>
              </CDataTable>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </div>
    <div>
      <CModal title="Modal title" color="info" :show.sync="infoModal">
        <CSelect
          label="Bulan"
          :options="bulanOptions"
          :value.sync="bulan"
          placeholder="Pilih Bulan"
        />
        <CSelect
          label="Tahun"
          :options="tahunOptions"
          :value.sync="tahun"
          placeholder="Pilih Tahun"
        />
        <template #footer>
          <CButton @click="infoModal = false" color="danger">Discard</CButton>
          <CButton @click="infoModal = false" color="success">Accept</CButton>
        </template>
      </CModal>
    </div>
  </div>
</template>

<script>
export default {
  name: "LaporanIndex",
  title: 'Laporan',
  data() {
    return {
      infoModal: false,
      bulan: "",
      bulanOptions: [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ],
      tahun: "",
      tahunOptions: ["2021", "2022", "2023", "2024", "2025"],
      items: [
          {
            'No.': 1,
            'Nama Laporan': "Laporan Presensi",
            'link' : 'laporan/presensi'
          },
          {
            'No.': 2,
            'Nama Laporan': "Laporan Fasilitas",
            'link' : 'laporan/fasilitas'
          },
          {
            'No.': 3,
            'Nama Laporan': "Laporan Tagihan dan Pembayaran",
            'link' : 'laporan/tagihan'
          },
           {
            'No.': 4,
            'Nama Laporan': "Jumlah Kartu Keluarga",
            'link' : 'laporan/kk'
          },

          
      ],
      fields: ['No.', 'Nama Laporan', 'show'],
    };
  },
};
</script>