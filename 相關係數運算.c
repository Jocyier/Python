#include <stdio.h>
#include <math.h>
#define n 19  //在此先修改陣列大小

int main(){
    
    float a[4][n]={0},b[4][n]={0},c[4][n]={0},sum=0,sum2=0,sums=0,ave=0,result;
    float ave2=0,sums2=0,result2;
    int i;
    for(i=0;i<n;i++){
        printf("Input a[0][%d] :",i+1);
        scanf("%f",&a[0][i]);
        sum += a[0][i];
    }
    printf("\n");
    for(i=0;i<n;i++){
        printf("Input a[1][%d] :",i+1);
        scanf("%f",&a[1][i]);
        sum2 += a[1][i];
    }
    
    for(i=0;i<n;i++){
        printf("%.1f    %.1f\n",a[0][i],a[1][i]);
    }
    
    ave = sum / n;
    ave2 = sum2/n;
    printf("----------------------------------------\n");
    printf("average are %.2f and %.2f\n",sum / n , sum2 /n);
    printf("----------------------------------------\n");

    
    float r=0;                                  //平均差
    for(i=0;i<n;i++){
        b[0][i] = a[0][i] - ave;
        b[1][i] = a[1][i] - ave2;
        printf("%.2f    %.2f\n",b[0][i],b[1][i]);
        r += ( b[0][i] *b[1][i]);
    }
    
    
    float d[2] ={0};                            //平方加總開根號
    for(i=0;i<n;i++){
        d[0] +=( b[0][i] * b[0][i] );
    }
    for(i=0;i<n;i++){
        d[1] +=( b[1][i] * b[1][i] );
    }
    printf("----------------------------------------\n");
    printf("����[�`�}�ڸ��@%.4f      %.4f\n",sqrt(d[0]),sqrt(d[1]));
    printf("----------------------------------------\n");
    
    
    float e[2][n] = {0};                      //平均差除以平方加總開根號
    for(i=0;i<n;i++){
        e[0][i] = (b[0][i] / (sqrt(d[0]))) ;
        e[1][i] = (b[1][i] / (sqrt(d[1]))) ;
        printf("%.4f    %.4f\n",e[0][i],e[1][i]);

    }
        
    
    for(i=0;i<n;i++){
        c[0][i] = b[0][i] *b[0][i];
        c[1][i] = b[1][i] *b[1][i];
        sums += c[0][i];
        sums2 += c[1][i];
    }
    
    sums /=n-1;
    result = sqrt(sums);
    printf("----------------------------------------\n");
    printf("Standard Deviation %.4f and ",result);

    sums2 /=n-1;
    result2 = sqrt(sums2);
    printf("%.4f\n",result2);

    r /= result *result2;
    printf("�����Y��%.4f\n",r/(n-1));
    printf("----------------------------------------\n");

}
 
