<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Laporan</h2>
            <div class="d-flex">
              <CSelect
              class="mr-2"
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
            </div>
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
                <router-link :to="item.link + '?bulan=' + bulan + '&tahun=' + tahun">
                    <CButton color="primary">Check</CButton>
                </router-link>
                </td>
              </template>
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
  <!-- <div class="wrapper">
    <div>
    </div>
    <div>
      <CModal title="Generate Laporan" :show.sync="infoModal">
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
  </div> -->
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
        {
          value: 1,
          label: "Januari",
        },
        {
          value: 2,
          label: "Februari",
        },
        {
          value: 3,
          label: "Maret",
        },
        {
          value: 4,
          label: "April",
        },
        {
          value: 5,
          label: "Mei",
        },
        {
          value: 6,
          label: "Juni",
        },
        {
          value: 7,
          label: "Juli",
        },
        {
          value: 8,
          label: "Agustus",
        },
        {
          value: 9,
          label: "September",
        },
        {
          value: 10,
          label: "Oktober",
        },
        {
          value: 11,
          label: "November",
        },
        {
          value: 12,
          label: "Desember",
        },
      ],
      tahun: "",
      tahunOptions: ['2021'],
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
  mounted() {
    const yearStart = 2021;
    const date = new Date();
    const yearPassed = date.getFullYear() - yearStart;
    for (let i = 1; i <= yearPassed; i++) {
      this.tahunOptions.push((yearStart + i).toString());
    }
    this.tahun = date.getFullYear().toString();
    this.bulan = date.getMonth() + 1;
  }
};
</script>