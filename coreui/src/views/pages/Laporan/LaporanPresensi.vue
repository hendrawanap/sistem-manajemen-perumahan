<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Laporan Presensi</h2>
            <div class="d-flex align-items-end">
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
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
export default {
    name : "LaporanPresensi",
    data(){
        return {
            items : [
                {
            'No.': 1,
            'Tanggal Presensi': "2021-11-10",
            'Jumlah Kehadiran' : '30/200'
            },
            {
            'No.': 2,
            'Tanggal Presensi': "2021-11-10",
            'Jumlah Kehadiran' : '20/200'
            },
             {
            'No.': 3,
            'Tanggal Presensi': "2021-11-10",
            'Jumlah Kehadiran' : '20/150'
             },
             {
            'No.': 4,
            'Tanggal Presensi': "2021-11-10",
            'Jumlah Kehadiran' : '20/100'
             },
            ],
            fields : ['No.', 'Tanggal Presensi', 'Jumlah Kehadiran']

        }
    }
}
</script>