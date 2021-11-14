<template>
  <CRow>
    <CCol v-if="tagihan">
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Rincian Tagihan</h2>
          </div>
        </CCardHeader>
        <CCardBody>
          <CForm v-on:submit.prevent>
            <CInput
              label="Nama Tagihan"
              disabled
              type="text"
              v-model="tagihan.namaTagihan"
            />
            <CInput
              label="Tanggal"
              disabled
              type="date"
              v-model="tagihan.tanggal"
            />
            Rincian
            <CCard>
              <CCardBody>
                <CRow v-for="t in tagihan.rincian" :key="t.tipe">
                  <CCol>
                    <CInput
                      label="Tipe"
                      disabled
                      type="text"
                      v-model="t.tipe"
                    />
                  </CCol>
                  <CCol>
                    <CInput
                      label="Nominal"
                      disabled
                      type="number"
                      v-model="t.nominal"
                    />
                  </CCol>
                </CRow>
              </CCardBody>
            </CCard>
            <CInput label="Total Tagihan" disabled v-model="total" />
          </CForm>
        </CCardBody>
      </CCard>

      <CCard>
        <CCardHeader>
          <CIcon name="cil-justify-center" /><strong>Statistik Tagihan</strong>
        </CCardHeader>
        <CCardBody>
          <CCardGroup>
            <CWidgetProgressIcon
              :header="sudahLunas.toString()"
              :value="(sudahLunas / jumlahKK) * 100"
              text="Sudah Lunas"
              color="success"
              inverse
            >
              <CIcon name="cil-notes" height="36" />
            </CWidgetProgressIcon>
            <CWidgetProgressIcon
              :header="belumLunas.toString()"
              :value="(belumLunas / jumlahKK) * 100"
              text="Belum Lunas"
              color="danger"
              inverse
            >
              <CIcon name="cil-notes" height="36" />
            </CWidgetProgressIcon>
          </CCardGroup>
        </CCardBody>
      </CCard>
    </CCol>
    <CCol v-else>
      <CCard>
        <CCardBody>Tidak ada tagihan bulan ini</CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>


<script>
import axios from "axios";
export default {
  name: "LaporanTagihan",
  title: "Laporan Tagihan",
  computed: {
    total() {
      return this.tagihan.rincian
        .map((t) => t.nominal)
        .reduce((total, nominal) => total + nominal);
    },
    belumLunas() {
      return this.jumlahKK - this.sudahLunas;
    },
  },
  data() {
    return {
      tagihan: null,
      jumlahKK: 0,
      sudahLunas: 0,
    };
  },
  methods: {
    fetchLaporanTagihan() {
      const bulan = this.$route.query.bulan;
      const tahun = this.$route.query.tahun;
      axios
        .get(
          this.$apiAdress +
            "/api/laporanTagihan?bulan=" +
            bulan +
            "&tahun=" +
            tahun +
            "&token=" +
            localStorage.getItem("api_token")
        )
        .then((r) => {
          const tagihan = r.data.tagihan;
          if (tagihan) {
              this.tagihan = {
              namaTagihan: tagihan.namaTagihan,
              tanggal: tagihan.tanggalTagihan,
              rincian: JSON.parse(tagihan.rincian),
            };
            this.jumlahKK = r.data.jumlahKK;
            this.sudahLunas = r.data.sudah;
          }
        });
    },
  },
  mounted() {
    this.fetchLaporanTagihan();
  },
};
</script>