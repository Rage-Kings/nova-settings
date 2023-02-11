<template>
    <div>
        <ul class="flex border-b" v-if="showSections">
            <li class="-mb-px mr-1"
                v-for="(key, section) in sections"
            >
                <a class="bg-white inline-block py-2 px-4  font-semibold"
                   :class="isActive(section)"
                   @click="selectSection(section)"
                   href="#"
                >
                    {{ __(sectionName(section)) }}
                </a>
            </li>
        </ul>

        <section-settings :settings="settings" :panels="panels"></section-settings>
    </div>
</template>

<script>
    import SectionSettings from "./SectionSettings";
    export default {
        components: {
            SectionSettings
        },
        data: () => ({
            settings: {},
            panels: {},
            sections: {},
            activeSection: {}
        }),
        mounted() {
            Nova.request()
                .get("/nova-vendor/settings")
                .then(response => {
                    //console.log(response.data);
                    this.settings = response.data.settings;
                    this.sections = response.data.sections;
                    this.panels = this.sections[this.defaultSection]['panels'];
                    this.generateActiveSections();
                });
        },
        computed: {
            defaultSection() {
                return Object.keys(this.sections)[0];
            },
            showSections() {
                return Object.keys(this.sections).length === 1 ? false : true;
            }
        },
        methods: {
            selectSection(activeSection) {
                this.panels = this.sections[activeSection]['panels'];
                for (let section in this.activeSection) {
                    if (section === activeSection) {
                        this.activeSection[section] = true;
                    } else {
                        this.activeSection[section] = false;
                    }
                }
            },
            sectionName(name) {
                return name === '_default' ? 'Other' : name;
            },
            generateActiveSections() {
                let obj = {};
                Object.keys(this.sections).forEach(section => {
                    obj[section] = section === this.defaultSection ? true : false;
                });
                this.activeSection = obj;
            },
            isActive(section) {
                if (this.activeSection[section]) {
                    return {
                        'border-l border-t border-r rounded-t text-blue-700': true
                    }
                } else {
                    return {
                        'text-blue-500 hover:text-blue-800': true
                    }
                }
            },
        }
    };
</script>