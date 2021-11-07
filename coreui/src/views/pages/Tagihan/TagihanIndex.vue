<template>
  <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
          <div class="d-flex justify-content-between">
            <h2>Tagihan</h2>
            <router-link :to="'/tagihan/tambah'">
              <CButton color="primary"> Tambah </CButton>
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
            <template #More="{ item }">
              <td>
                <router-link :to="'/perizinan/edit/' + item.id">
                  <CButton><CIcon name="cil-options-horizontal" /></CButton>
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
export default {
  name: "TagihanIndex",
  data() {
    return {
      items: [
        {
          "No.": "1",
          "Nama Tagihan": "Heriawan",
          Tanggal: "3-11-2021",
        },
        {
          "No.": "2",
          "Nama Tagihan": "Herlambang",
          Tanggal: "2-11-2021",
        },
      ],
      fields: ["No.", "Nama Tagihan", "Tanggal", "More"],
    };
  },
};
</script>
