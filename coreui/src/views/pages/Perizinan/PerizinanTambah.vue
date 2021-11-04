<template>
    <CRow>
    <CCol>
      <CCard>
        <CCardHeader>
        <div class="d-flex justify-content-between">
              <h2>Tambah Perizinan</h2>
        </div>
        </CCardHeader>
        <CCardBody>
        <CForm v-on:submit.prevent>
            <CInput label="Nama Pegawai" type="text" id="inputNama"/>
            
            <CInput label="Tanggal" type="date" id="inputTanggal"/>
            <CInput label="Alasan"  type="text" id="inputAlasan" />
          
            <CButton type="submit" color="primary" @click="tambahPegawai()">
                Submit
            </CButton>
        </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>
