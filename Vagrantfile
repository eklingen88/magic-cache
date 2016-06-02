# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.provision :shell, path: "vagrant/bootstrap.sh"
  config.vm.network "private_network", ip: "10.0.0.10"
  config.vm.hostname = "magic-cache"
  config.vm.provider "virtualbox" do |v|
    v.memory = 4096
    v.cpus = 4
	v.name = "magic-cache"
  end
end
