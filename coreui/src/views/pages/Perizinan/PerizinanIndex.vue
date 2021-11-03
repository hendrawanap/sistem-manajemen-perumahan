<template>
  <CRow>
    <CCol>
    <CCard>
      <CCardHeader>
        <div class="d-flex justify-content-between">
          <h2>Perizinan</h2>
          <CButton color="primary" href="PerizinanBuat">Buat</CButton>
        </div>
      </CCardHeader>
      <CCardBodies>
        <CDataTable
              hover
              striped
              :items="items"
              :fields="fields"
              :items-per-page="5"
              pagination>
          </CDataTable>
      </CCardBodies>
    </CCard>
    </CCol>
  </CRow>
</template>
<script>
export default {
  name: "PerizinanIndex",
    data() {
    return {
      items: [
        {
          'No.': '1',
          'Nama Pegawai': 'Heriawan',
          'Tanggal': '3-11-2021',
          'Alasan': 'Males',
        },
        {
          'No.': '2',
          'Nama Pegawai': 'Herlambang',
          'Tanggal': '2-11-2021',
          'Alasan': 'Mules',
        },
      ],
      fields: ['No.', 'Nama Pegawai', 'Tanggal', 'Alasan'],
    }
  }
}
</script>
