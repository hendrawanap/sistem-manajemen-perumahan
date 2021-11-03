<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
        <div class="d-flex justify-content-between">
          <h2>Daftar Pegawai</h2>
          <router-link :to="'/pegawai/tambah'">
            <CButton color="primary">
              Tambah
            </CButton>
          </router-link>
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
                  <CButton class ="mr-2" color="primary">Edit</CButton>
                  <CButton class ="mr-2" color="danger">Hapus</CButton>
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
  name: "PegawaiIndex",
  data() {
    return {
      items: [
        {
          'no.': '1',
          'Nama Pegawai': 'Hendrawan',
          'Gender': 'Laki',
          'Alamat': 'Malang',
          'Tanggal Masuk': '3-10-2020',
          'Divisi': 'Kantoran',
          'Jabatan': 'Supervisor'
        },
      ],
      fields: ['no.', 'Nama Pegawai', 'Gender', 'Alamat', 'Tanggal Masuk', 'Divisi', 'Jabatan', 'action'],
    }        
  }
  
}
</script>