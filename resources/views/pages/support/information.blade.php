<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-3 sm:col-span-3">
                
                <div class="mt-12 mx-auto ">
                    <div class="inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex">
                        <div class="bg-white overflow-hidden rounded-md shadow-xl transform transition-all w-full">
                            <div>
                                <div class="align-middle bg-lighterblue border-b p-3 text-center">
                                    <h3 class="font-bold font-medium leading-6 text-gray-700 text-lg text-red-50">
                                        System Requirements
                                    </h3>
                                </div>
                            </div>
                            <div class="p-4">
                                <span class="flex w-full shadow-sm">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-full sm:col-span-full">
                                            <p>
                                                **Click in the icon image to download.
                                            </p>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="flex items-stretch">
                                                <div class="w-2/12">
                                                    <a href="https://www.google.com/intl/es/chrome/browser/?hl=es">
                                                        <img src="{{ asset('icons/google-chrome.jpg') }}" class="w-full">
                                                    </a>
                                                </div>
                                                <div class="m-auto pl-2">
                                                    <label class="text-sm">Google Chrome, default web browser to use the system.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="flex items-stretch">
                                                <div class="w-2/12">
                                                    <a href="https://www.mozilla.org/es-ES/firefox/new/">
                                                        <img src="{{ asset('icons/firefox.png') }}" class="w-full">
                                                    </a>
                                                </div>
                                                <div class="m-auto pl-2">
                                                    <label class="text-sm">Firefox, alternative web browser to use the system.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="flex items-stretch">
                                                <div class="w-8/12">
                                                    <a href="https://www.foxitsoftware.com/downloads/thanks.html?product=Foxit-Reader&platform=Windows">
                                                        <img src="{{ asset('icons/foxitreader.png') }}" class="w-full">
                                                    </a>
                                                </div>
                                                <div class="m-auto pl-2">
                                                    <label class="text-sm">Foxit Reader is a free distribution program, which allows the correct visualization of documents online. This component is required by the reporting system and ticket sales.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="flex items-stretch">
                                                <div class="w-8/12">
                                                    <a href="http://www.teamviewer.com/download/TeamViewer_Setup_es.exe">
                                                        <img src="{{ asset('icons/teamviewer.png') }}" class="w-full">
                                                    </a>
                                                </div>
                                                <div class="m-auto pl-2">
                                                    <label class="text-sm">Teamviewer is a program of free distribution, which allows remote assistance. Through this program, the support team has access and control your PC to help solve problems. If you require assistance from support team must provide the Id and Password for access generated by the program.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2">
                                            <div class="flex items-stretch">
                                                <div class="w-8/12">
                                                    <a href="https://anydesk.com/en/downloads">
                                                        <img src="{{ asset('icons/anydesk.png') }}" class="w-full">
                                                    </a>
                                                </div>
                                                <div class="m-auto pl-2">
                                                    <label class="text-sm">AnyDesk is a remote desktop application distributed by AnyDesk Software GmbH. The proprietary software program provides platform independent remote access to personal computers and other devices running the host application. It offers remote control, file transfer, and VPN functionality.</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-1 sm:col-span-1">
                <div class="mt-12 mx-auto ">
                    <div class="inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex">
                        <div class="bg-white overflow-hidden rounded-md shadow-xl transform transition-all w-full">
                            <div>
                                <div class="align-middle bg-lighterblue border-b p-3 text-center">
                                    <h3 class="font-bold font-medium leading-6 text-gray-700 text-lg text-red-50">
                                        Support Information
                                    </h3>
                                </div>
                            </div>
                            <div class="p-4">
                                <span class="flex w-full shadow-sm">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-full sm:col-span-full">
                                            <p class="text-sm">
                                                Our clients are most important to us, we operate a help desk to assist you with all your needs regarding with our System.
                                            </p>
                                            <p class="mt-2 text-sm">
                                                New Support System:
                                                <a href="mailto:example.com">example.com</a> 
                                            </p>
                                            <p class="mt-2 text-sm">
                                                USA:
                                                Send email to:
                                                <a href="mailto:example@example.com">example@example.com</a> 
                                                
                                            </p>
                                            <p class="mt-2 text-sm">
                                                Contact Us:
                                                USA:
                                                <a href="tel:111-111-1111">(Linea 1): 111-111-1111</a> 
                                            </p>
                                        </div>
                                        
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</x-app-layout>
