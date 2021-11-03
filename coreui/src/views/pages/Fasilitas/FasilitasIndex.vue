<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div class="d-flex justify-content-between">
                        <h2>Daftar Fasilitas</h2>
                        <router-link :to="'/fasilitas/tambah'">
                        <CButton color="primary">Tambah</CButton>
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
                        pagination 
                        >
                        <template #action>                    
                            <td>
                                <CButton color="primary">Edit</CButton>
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
export default{ 
    name: "KKIndex",
    data() {
    return {
      items: [
        {
          'No.': '1',
          'Nama Fasilitas': 'Kolam Renang',
          'Kondisi': 'Terbengkalai',
          'Informasi': 'Butuh dana',
          'Action': 'awawa' 
        },
      ],
      fields: ['No.', 'Nama Fasilitas', 'Kondisi', 'Informasi', 'action'],
    }
  }
}
</script>
