<x-app-layout>
	<div class="mx-auto sm:px-6 lg:px-8 py-6">
	    <div class="flex items-center">
	        <div class="text-base mr-auto">
	            <span class="font-semibold mr-3">{{__('Option Management')}}</span>
	        </div>
	    </div>

	    <tab v-slot="{ selected, menuChanged }">
    	    <div>
    	      	<div class="hidden sm:block mt-4 ml-16">
    	        	<nav class="flex">
    	          		<a href="#" @click="menuChanged('Boletoxpress')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Boletoxpress' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Boletoxpress
    	          		</a>
    	          		<a href="#" @click="menuChanged('Colors')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Colors' ? 'bg-darkblue bg-white text-gray-50' : ''">
    						Colors
    	          		</a>
    	          		<a href="#" @click="menuChanged('Luggage')" class="inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4 text-sm focus:outline-none focus:bg-darkblue" :class="selected === 'Luggage' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Luggage
    	          		</a>
    	          		<a href="#" @click="menuChanged('FE')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'FE' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		FE
    	          		</a>
    	          		<a href="#" @click="menuChanged('General')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'General' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		General
    	          		</a>
    	          		<a href="#" @click="menuChanged('Manual')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Manual' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Manual
    	          		</a>
    	          		<a href="#" @click="menuChanged('Helpdesk')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Helpdesk' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Helpdesk
    	          		</a>
    	          		<a href="#" @click="menuChanged('Packaging')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Packaging' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Packaging
    	          		</a>
    	          		<a href="#" @click="menuChanged('Tickets')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Tickets' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Tickets
    	          		</a>
    	          		<a href="#" @click="menuChanged('Web Sales')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150 ml-4  text-sm focus:outline-none" :class="selected === 'Web Sales' ? 'bg-darkblue bg-white text-gray-50' : ''">
    	            		Web Sales
    	          		</a>
    	        	</nav>
    	      	</div>

                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Luggage'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Maximum number of labels printing"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Cobro de monto libre de impuestos por reimpresión de excesos de equipaje facturados al cliente." divLabelClass="mt-3 px-11 sm:mt-5 text-left" textSize="text-sm" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Credit card payment" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Confirmation of cancellation by password" type="modified" divLabelClass="mt-3 px-1 sm:mt-5 text-center" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allow enter suitcases number" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Apply discount" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Generation of labels" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Enable tax" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Manual registration of luggage" type="modified"></x-option-card>
                        </div>


                        <div class="col-span-full sm:col-span-full mt-4">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate excess luggage by suitcases number" singleBtnLabel="Group of Options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate collection of excess luggage by weight" singleBtnLabel="Group of Options"></x-option-card>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Colors'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Bus with sales"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Confirmed bus"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Expired ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Canceled ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Full bus"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Sold ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Manual sale ticket by terminal"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Manual sale ticket by agent"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Manual sale voucher by terminal"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Reserved ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Reprinted ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Bus without sales"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Expired reserved ticket"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Open expired ticket"></x-option-card>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'FE'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activa o desactiva el ingreso de decimales en la cantidad" type="modified"></x-option-card>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Mostrar resultados de documentos electrónicos según login de usuario" type="modified"></x-option-card>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="No mostrar documentos anulados en el envio a Facturacion Electronica" type="modified"></x-option-card>
                        </div>

                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Opciones para generar notas de crédito" singleBtnLabel="Group of Options"></x-option-card>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'General'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Número de veces permitidas para postergar un boleto" divLabelClass="mt-3 px-11 sm:mt-5 text-left" textSize="text-sm" buttonMarginWithLabel="" textSize="text-lg"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Accounting account"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Service Occupation Group Identifier"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Service Occupation Group Identifier"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Identificador del grupo de notificación por refund automático en pasarela de pago" divLabelClass="mt-3 px-11 sm:mt-5 text-left" textSize="text-sm" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Formato de Nota a Enviar"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Codigo de empresa para manifiesto APIS" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Pasword de empresa para manifiesto APIS" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Overwrite the commission of an agent" type="modified" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notification of messages to defined groups" type="modified" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General chat" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Use filter of available schedule in nearby cities" type="modified" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Rounding of amounts in sales" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows to show the DNI in documents" type="modified" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="El sistema realiza el canje automático de la acumulación de puntos" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-left" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate menus for mobile express sale" type="modified" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Show reservations by office" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Integración del API de mailchimp para actualizar una lista con subscriptore" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-left" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate the functionalities to execute the sending of members to a list of mailchimp" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-left" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Integración del API de mailchimp para actualizar una lista con subscriptore" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-left" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Permite la exlusión de ciudades en multirutas" type="modified" textSize="text-sm" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Postergación de boleto muestra opciones de impresión" type="modified" textSize="text-md" buttonMarginWithLabel="mt-6 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Aplicación de Promociones por Grupo de Rutas" type="modified" textSize="text-md" buttonMarginWithLabel="mt-6 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Password rules" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Manifiesto de Pasajeros de Sintomologia covid-19" type="modified" textSize="text-md"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Permitir configuración de copias de impresión Thermal" type="modified" textSize="text-md"></x-option-card>
                        </div>

                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Chose the different forms of payment" singleBtnLabel="Group of Options" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Agencies - choose different type of payment" singleBtnLabel="Group of Options" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General options for the ticket module" singleBtnLabel="Group of Options" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Series and correlative options" singleBtnLabel="Group of Options" textSize="text-sm"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Use of credit gateways" singleBtnLabel="Group of Options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General reporting options" singleBtnLabel="Group of Options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notificación diaria del reporte de ocupación diaria" singleBtnLabel="Group of Options" textSize="text-sm" buttonMarginWithLabel="mt-6 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Use itinerary occupancy notification by email" singleBtnLabel="Group of Options" textSize="text-sm" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General coupon options" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General coupon options" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General rules of itineraries" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General administration options" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General options of shuttle service" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notifications for cancellation" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate use of tax" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General multiroute options" singleBtnLabel="Group of Options" ></x-option-card>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Manual'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activado muestra un checkbox para ingreso de montos con o sin IGV según el estado del checkbox" type="modified" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activated: In manual documents in the price field you enter the total price of the items, Deactivated: In the price you must enter the unit price of the items" type="modified" divLabelClass="mt-3 px-11 sm:mt-5 text-left" textSize="text-sm" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate or deactivate the item search field in manual documents" type="modified" divLabelClass="mt-11 sm:mt-11 text-center"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activa o desactiva el calculo de cantidad basado en el precio total" type="modified" divLabelClass="mt-11 sm:mt-11 text-center"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Agrega documento guía" type="modified" divLabelClass="mt-11 sm:mt-11 text-center"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Registrar Unidad de Medida por detalle" type="modified" ></x-option-card>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Helpdesk'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Email for created task" type="modified"></x-option-card>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Packaging'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Number of times the document prints"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Cobro de monto libre de impuestos por reimpresión de documentos facturados al cliente" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Option to lose and find package" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notes on the package sending" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows card payment" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing of the document of the sending to home" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate authorization in the manual price" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activa o no el registro de paquetes por cobrar" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Guía de Remisión agrupado por oficina de destino" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="DNI obligatorio para el destinatario" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Lector QR de Equipaje" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows payment with business credit" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing with barcode in package registration" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel="mt-5 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Phone number required" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Send mail to sender" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Web tracking of package" type="modified"></x-option-card>
                        </div>


                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Recipient key rules"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Carrier remission guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General cash send options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Different price calculation in addition to the manual" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Remission guide emission on package registration" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Referral guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package detail registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package shipping types"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Minimum price in package registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="It allows to cancel package sending"></x-option-card>
                        </div>

                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Tickets'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Number of times the document prints"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Cobro de monto libre de impuestos por reimpresión de documentos facturados al cliente" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Option to lose and find package" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notes on the package sending" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows card payment" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing of the document of the sending to home" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate authorization in the manual price" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activa o no el registro de paquetes por cobrar" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Guía de Remisión agrupado por oficina de destino" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="DNI obligatorio para el destinatario" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Lector QR de Equipaje" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows payment with business credit" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing with barcode in package registration" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel="mt-5 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Phone number required" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Send mail to sender" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Web tracking of package" type="modified"></x-option-card>
                        </div>


                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Recipient key rules"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Carrier remission guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General cash send options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Different price calculation in addition to the manual" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Remission guide emission on package registration" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Referral guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package detail registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package shipping types"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Minimum price in package registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="It allows to cancel package sending"></x-option-card>
                        </div>

                    </div>
                </div>
                <div class="px-5 py-5 sm:p-16" v-if="selected === 'Web Sales'">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Individual Options</x-label>
                        </div>
                        
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Number of times the document prints"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Cobro de monto libre de impuestos por reimpresión de documentos facturados al cliente" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel=""></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Option to lose and find package" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Notes on the package sending" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows card payment" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing of the document of the sending to home" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activate authorization in the manual price" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Activa o no el registro de paquetes por cobrar" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Guía de Remisión agrupado por oficina de destino" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="DNI obligatorio para el destinatario" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Lector QR de Equipaje" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Allows payment with business credit" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Printing with barcode in package registration" type="modified" textSize="text-sm" divLabelClass="mt-3 px-11 sm:mt-5 text-center" buttonMarginWithLabel="mt-5 sm:mt-6"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Phone number required" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Send mail to sender" type="modified"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Web tracking of package" type="modified"></x-option-card>
                        </div>


                        <div class="col-span-full sm:col-span-full">
                            <x-label for="name" class="font-semibold text-4xl">Grouped Options</x-label>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Recipient key rules"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Carrier remission guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="General cash send options"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Different price calculation in addition to the manual" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Remission guide emission on package registration" buttonMarginWithLabel="mt-5 sm:mt-6" ></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Referral guide"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package detail registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Package shipping types"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="Minimum price in package registration"></x-option-card>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <x-option-card label="It allows to cancel package sending"></x-option-card>
                        </div>

                    </div>
                </div>
    	    </div>

	    </tab>
	</div>
</x-app-layout>