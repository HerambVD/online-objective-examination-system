## Instructions to deploy Flask application on AWS EC2 G4 Instances

#### Environment Setup

Execute following commands:

```
$sudo apt-get update
$sudo apt-get upgrade -y
$sudo apt-get install build-essential
$sudo apt-get upgrade -y linux-aws
$wget https://developer.download.nvidia.com/compute/cuda/repos/ubuntu1804/x86_64/cuda-repo-ubuntu1804_10.1.243-1_amd64.deb
$sudo apt-key adv --fetch-keys https://developer.download.nvidia.com/compute/cuda/repos/ubuntu1804/x86_64/7fa2af80.pub
$sudo dpkg -i cuda-repo-ubuntu1804_10.1.243-1_amd64.deb
$sudo apt-get update
$wget http://developer.download.nvidia.com/compute/machine-learning/repos/ubuntu1804/x86_64/nvidia-machine-learning-repo-$ubuntu1804_1.0.0-1_amd64.deb
$sudo apt install ./nvidia-machine-learning-repo-ubuntu1804_1.0.0-1_amd64.deb
$sudo apt-get update
$sudo apt-get install --no-install-recommends nvidia-driver-450

$sudo apt-get install --no-install-recommends 
    cuda-10-0
    libcudnn7=7.6.5.32-1+cuda10.0  
    libcudnn7-dev=7.6.5.32-1+cuda10.0

$sudo apt-get install -y --no-install-recommends libnvinfer6=6.0.1-1+cuda10.0
    libnvinfer-dev=6.0.1-1+cuda10.10
    libnvinfer-plugin6=6.0.1-1+cuda10.0
```
Check CUDA version:
```
$nvcc  – version
```
Check if NVIDIA Driver is installed :
```
$nvidia-smi
```

If CUDA version and NVIDIA Drive is found then move on to the Flask App Deployment otherwise follow the instructions below:

The application that we have developed uses tesorflow-gpu _v1.15.0_, tf-_1.15.0_ requires cuda version 10-0 and cudnn intalled in the intance. To install these, execute the following commands in the Instance terminal.

Remove any NVIDIA traces you may have on the instance.
```
$sudo rm /etc/apt/sources.list.d/cuda*
$sudo apt remove --autoremove nvidia-cuda-toolkit
$sudo apt remove --autoremove nvidia-*
```

```
$sudo apt update
$sudo add-apt-repository ppa:graphics-drivers

$sudo apt-key adv --fetch-keys  http://developer.download.nvidia.com/compute/cuda/repos/ubuntu1804/x86_64/7fa2af80.pub

$sudo bash -c 'echo "deb http://developer.download.nvidia.com/compute/cuda/repos/ubuntu1804/x86_64 /" > /etc/apt/sources.list.d/cuda.list'

$sudo bash -c 'echo "deb http://developer.download.nvidia.com/compute/machine-learning/repos/ubuntu1804/x86_64 /" > /etc/apt/sources.list.d/cuda_learn.list'

$sudo apt update
$sudo apt install cuda-10-0
$sudo apt install libcudnn7
```

The last step is to specify PATH to CUDA in '.profile' file. Open file by running:
```
$sudo vi ~/.profile
```
And add the following lines at the end of the file:

```
# set PATH for cuda 10.1 installation
if [ -d "/usr/local/cuda-10.1/bin/" ]; then
    export PATH=/usr/local/cuda-10.1/bin${PATH:+:${PATH}}
    export LD_LIBRARY_PATH=/usr/local/cuda-10.1/lib64${LD_LIBRARY_PATH:+:${LD_LIBRARY_PATH}}
fi
```

Restart and check the versions for the installation and Driver.
```
$nvcc  – version
$nvidia-smi
```
For detailed cuda installation information refer [this](https://medium.com/@exesse/cuda-10-1-installation-on-ubuntu-18-04-lts-d04f89287130 "CUDA 10.1 installation on Ubuntu 20.04") . This article explains cuda 10.1 installation.


#### Flask app Deployment

```
$sudo apt install python3
$sudo apt install python3-pip
$python3 -m pip --upgrade pip
```
Move/Upload the source code of the flask application on the AWS Instance.
Change the present working directory to the main directory of the Flask application:
```
$cd <app_main_directory>
```
Install all dependencies and requirements:
```
$pip3 install -r requirements.txt
```
Set up the Python path variables:
```
$export PYTHONPATH=$PYTHONPATH:`pwd`
$export PYTHONPATH=$PYTHONPATH:`pwd`/objectDetection
$export PYTHONPATH=$PYTHONPATH:`pwd`/objectDetection/object_detection
$export PYTHONPATH=$PYTHONPATH:/home/ubuntu/.local/bin
```

To start the server run app.py file in the parent directory.

Note: Once the flask app is deployed try importing tensorflow-gpu _v1.15.0_ in the python3 interpreter. If the import throws error then refer [this](https://medium.com/@exesse/cuda-10-1-installation-on-ubuntu-18-04-lts-d04f89287130 "CUDA 10.1 installation on Ubuntu 20.04") article for proper installation of CUDA.
