<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div  v class="d-flex justify-content-between">
                        <h2>Edit KK</h2>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CForm v-on:submit.prevent>                                     
                        <CInput label="Nomor KK" type="text" id="noKKInput" v-model="KK.noKK"/>
                        <CInput label="Alamat" type="text" id="alamatInput" v-model="KK.alamat"/>
                        <CInput label="Kepala Keluarga" type="text" id="kepalaKeluargaInput" v-model="KK.kepalaKeluarga"/>
                        <router-link :to="'/KK'" >
                            <CButton type="submit" color="primary" @click="addKK()" >Submit</CButton>
                        </router-link>
                    </CForm>
                </CCardBody>
            </CCard>
        </CCol>
    </CRow>
</template>

<script>
import axios from 'axios'
export default {
    name: "Edit KK",
    data() {
        return {
            KK: {
                noKK : "",
                alamat : "",
                kepalaKeluarga : ""
            }
        }
    },
    methods: {
        editKK(){
            const formData = new FormData()
            const KK = this.KK
            formData.append("nomorKK", KK.noKK);
            formData.append("alamat", KK.alamat);
            formData.append("kepalaKeluarga", KK.kepalaKeluarga);

            axios.post(this.$apiAdress + '/api/KK/edit/' + this.$route.params.id, formData).then( r => console.log('berhasil diubah'))
        },
        getKK(){
            axios.get(this.$apiAdress + '/api/KK/' + this.$route.params.id).then( r => {
                const data = r.data[0];
                this.KK = {
                    noKK: data.nomorKK,
                    alamat: data.alamat,
                    kepalaKeluarga: data.kepalaKeluarga
                }
            })
        }
    },
    mounted() {
        this.getKK();
    }
}
</script>