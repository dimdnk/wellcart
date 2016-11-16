# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/xenial64"
  config.vm.provider "virtualbox" do |vb|
     vb.name = "WellCart Vagrant"
     vb.memory = 4096
	 vb.cpus = 2
  end
  config.vm.synced_folder "./", "/var/www/html/wellcart/", :mount_options => ["dmode=777", "fmode=777"]

  ## Bootstrap script to provision box.  All installation methods can go here.
  config.vm.provision "shell" do |s|
    s.path = "bin/setup-environment.sh"
  end

  config.vm.network "forwarded_port", guest: 80, host: 8080
end