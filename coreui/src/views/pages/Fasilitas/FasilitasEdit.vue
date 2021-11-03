<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div  v class="d-flex justify-content-between">
                        <h2>Edit Fasilitas</h2>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CForm>                                     
                        <div class="mb-3">
                            <CFormLabel>Nama Fasilitas</CFormLabel>
                            <CInput type="text" id="FasilitasInput"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel>Kondisi</CFormLabel>
                            <CInput type="text" id="KondisiInput" />
                        </div>
                        <div class="mb-3">
                            <CFormLabel>Informasi</CFormLabel>
                            <CInput type="text" id="InformasiInput" />
                        </div>
                        <CButton type="submit" color="primary">Simpan</CButton>
                    </CForm>
                </CCardBody>
            </CCard>
            </CCol>
    </CRow>
</template>

<script>
export default {
    name: "Edit Fasilitas",
}
</script>