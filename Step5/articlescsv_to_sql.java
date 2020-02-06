import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.Scanner;

/**
 * This application is built to change the csv file into json file which can be
 * imported by mongoDB.
 *
 * @author YilongWu (A00429725)
 */
public class articlescsv_to_sql {

    public static void main(String[] args) throws FileNotFoundException {
        File file = new File("./New_Article.csv");
        Scanner fin = new Scanner(file);
        PrintWriter fout = new PrintWriter(new File("article1.sql"));

        // read the data from the csv.file


        while (fin.hasNext()) {

            String temp1 = fin.nextLine();

            String[] temp = temp1.split(",");
            String[][] str = new String[50][20];

            for (int i = 0; i < temp.length; i++) {
                String[] temp2 = temp[i].split(":");
                for (int j = 0; j < temp2.length; j++) {
                    str[i][j] = temp2[j].replace("\"", "").replace("}", "");
                }
            }

            fout.print("insert into ARTICLE(Title, pages, volumeNumber, Magazine_id) values");
            fout.println("(\"" + str[2][1] + "\", \"" + str[3][1] + "\", \"" 
                    + str[1][1] + "\", \"" + str[0][1] + "\");");

        }

        fin.close();
        fout.close();

    }

}
