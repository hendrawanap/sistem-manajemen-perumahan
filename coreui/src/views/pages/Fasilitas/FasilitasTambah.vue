<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div  v class="d-flex justify-content-between">
                        <h2>Tambah Fasilitas</h2>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CForm>                                     
                        <div class="mb-3">
                            <CFormLabel for="FasilitasInput">Nama Fasilitas</CFormLabel>
                            <CInput type="text" id="FasilitasInput" v-model="fasilitas.namaFasilitas"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="KondisiInput">Kondisi</CFormLabel>
                            <CInput type="text" id="KondisiInput" v-model="fasilitas.kondisi"/>
                        </div>
                        <div class="mb-3">
                            <CFormLabel for="InformasiInput">Informasi</CFormLabel>
                            <CInput type="text" id="InformasiInput" v-model="fasilitas.informasi"/>
                        </div>
                        <CButton type="submit" color="primary" @click="submit()" >
                        Submit</CButton>
                    </CForm>
                </CCardBody>
            </CCard>
            </CCol>
    </CRow>
</template>

<script>
export default {
    name: "Tambah Fasilitas",
    data() {
        return {
            namaFasilitas : "",
            kondisi : "",
            informasi : ""
        }
    },
    methods: {
        submit() {
            console.log(this.fasilitas)
        }
    }
}
</script>