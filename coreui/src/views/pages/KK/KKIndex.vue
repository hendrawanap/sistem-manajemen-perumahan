<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Daftar KK</h2>
            <CButton color="primary">Tambah</CButton>
          </div>
        </CCardHeader>
        <CCardBody>
          <CDataTable
            hover
            striped
            :items="items"
            :fields="fields"
            :items-per-page="5"
            pagination>
            <template #action>
              <td>
                <CButton color="primary" class="mr-2">Edit</CButton>
                <CButton color="danger">Hapus</CButton>
              </td>
            </template>
          </CDataTable>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
export default {
  name: "KKIndex",
  data() {
    return {
      items: [
        {
          'no.': '1',
          'nomor KK': '3507231198475594',
          'alamat': 'Karangploso',
          'kepala Keluarga': 'Baps',
        },
        {
          'no.': '2',
          'nomor KK': '3507231198475594',
          'alamat': 'Karangploso',
          'kepala Keluarga': 'Wira',
        },
      ],
      fields: ['no.', 'nomor KK', 'alamat', 'kepala Keluarga', 'action'],
    }
  }
}
</script>